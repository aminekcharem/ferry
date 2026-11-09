import test from 'node:test';
import assert from 'node:assert/strict';
import { readFileSync } from 'node:fs';
import { runInNewContext } from 'node:vm';
import { webcrypto } from 'node:crypto';

const source = readFileSync(new URL('../../resources/js/tombola.js', import.meta.url), 'utf8');
const result = { result: 20, next_allowed_at: '2027-01-02T12:00:00Z' };

class Element {
    hidden = false;
    disabled = false;
    textContent = '';
    value = '';
    listeners = {};
    children = [];
    attributes = {};
    open = false;
    addEventListener(name, callback) { this.listeners[name] = callback; }
    setAttribute(name, value) { this.attributes[name] = value; }
    removeAttribute(name) { delete this.attributes[name]; }
    querySelectorAll() { return []; }
    replaceChildren(...children) { this.children = children; }
    append(child) { this.children.push(child); }
    animate() { return { finished: Promise.resolve() }; }
    showModal() { this.open = true; }
    close() { this.open = false; this.listeners.close?.(); }
    focus() {}
    reportValidity() { return true; }
}

async function harness({ fetchSpin, previous = null, pending = null, recover = null, storageDenied = false } = {}) {
    const nodes = new Map();
    for (const name of ['copy', 'dialog', 'open', 'form', 'submit', 'result', 'error', 'wheel', 'close']) nodes.set(`[data-tombola-${name}]`, new Element());
    const copy = Object.fromEntries(['loading', 'spin', 'win', 'discount', 'lose', 'next', 'sent', 'error', 'invalid', 'blocked', 'inactive', 'token', 'rate', 'storage'].map((key) => [key, key]));
    nodes.get('[data-tombola-copy]').textContent = JSON.stringify(copy);
    const form = nodes.get('[data-tombola-form]');
    form.elements = Object.assign(['last_name', 'first_name', 'email', 'phone'].map(() => new Element()), {
        last_name: { value: 'Lovelace' }, first_name: { value: 'Ada' }, email: { value: 'ada@example.com' }, phone: { value: '+491234567890' },
    });
    const root = {
        dataset: { locale: 'fr', statusUrl: '/status', spinUrl: '/spin', resultUrl: '/result' },
        querySelector: (selector) => nodes.get(selector), querySelectorAll: () => [],
    };
    const storage = new Map([['yesmin-tombola:localhost:device', 'a29ecab6-4d7a-4350-b27f-a2017a2ffb97']]);
    if (pending) storage.set('yesmin-tombola:localhost:pending', JSON.stringify(pending));
    const localStorage = {
        getItem(key) { if (storageDenied) throw Error('denied'); return storage.get(key) ?? null; },
        setItem(key, value) { if (storageDenied) throw Error('denied'); storage.set(key, value); },
        removeItem(key) { storage.delete(key); },
    };
    let loaded;
    const timers = [];
    const calls = [];
    runInNewContext(source, {
        document: { addEventListener: (name, callback) => { loaded = callback; }, querySelector: (selector) => selector === '[data-tombola]' ? root : null, createElement: () => new Element() },
        crypto: webcrypto, location: { host: 'localhost' }, localStorage,
        sessionStorage: { getItem: () => null, setItem: () => {} },
        setTimeout: (callback) => timers.push(callback), matchMedia: () => ({ matches: true }),
        AbortSignal, window: { confirm: () => true },
        fetch: async (url, options) => {
            const data = JSON.parse(options.body);
            calls.push({ url, data, options });
            if (url === '/spin') return fetchSpin ? fetchSpin(data) : { ok: true, json: async () => result };
            return { ok: true, json: async () => url === '/result' ? { previous: recover } : { active: true, eligible: !previous, token: 'signed-token', generation: 0, previous } };
        },
    });
    await loaded();
    return { nodes, calls, timers, storage, submit: () => form.listeners.submit({ preventDefault() {} }) };
}

test('submits all four mandatory fields without cookies and displays the server result', async () => {
    const app = await harness();
    assert.equal(app.timers.length, 1);
    app.timers[0]();
    assert.equal(app.nodes.get('[data-tombola-dialog]').open, true);
    await app.submit();
    const spin = app.calls.find((call) => call.url === '/spin');
    assert.equal(spin.data.first_name, 'Ada');
    assert.equal(spin.data.last_name, 'Lovelace');
    assert.equal(spin.data.email, 'ada@example.com');
    assert.equal(spin.data.phone, '+491234567890');
    assert.equal(spin.options.credentials, 'omit');
    assert.equal(app.nodes.get('[data-tombola-result]').hidden, false);
    assert.match(app.nodes.get('[data-tombola-result]').children[0].textContent, /20/);
    assert.equal(app.nodes.get('[data-tombola-form]').hidden, true);
});

test('double clicks cannot submit a second request while the first is in progress', async () => {
    let finish;
    const app = await harness({ fetchSpin: () => new Promise((resolve) => { finish = resolve; }) });
    const first = app.submit();
    await app.submit();
    await new Promise((resolve) => setImmediate(resolve));
    assert.equal(app.calls.filter((call) => call.url === '/spin').length, 1);
    finish({ ok: true, json: async () => result });
    await first;
});

test('an interrupted request reuses the same idempotency key and saved fields', async () => {
    let attempts = 0;
    const app = await harness({ fetchSpin: async () => {
        if (++attempts === 1) throw new Error('Network failure after server commit');
        return { ok: true, json: async () => result };
    } });
    await app.submit();
    assert.equal(app.nodes.get('[data-tombola-error]').textContent, 'error');
    await app.submit();
    const spins = app.calls.filter((call) => call.url === '/spin');
    assert.equal(spins[0].data.request_id, spins[1].data.request_id);
    assert.equal(app.storage.has('yesmin-tombola:localhost:pending'), false);
});

test('reload recovers a committed result without spinning again', async () => {
    const app = await harness({ pending: { device_id: 'a29ecab6-4d7a-4350-b27f-a2017a2ffb97', request_id: 'saved-request' }, recover: result, previous: result });
    assert.equal(app.calls.filter((call) => call.url === '/spin').length, 0);
    assert.equal(app.nodes.get('[data-tombola-result]').hidden, false);
    assert.equal(app.timers.length, 0);
});

test('storage denied in an iframe produces a clear message without a spin', async () => {
    const app = await harness({ storageDenied: true });
    await app.submit();
    assert.equal(app.nodes.get('[data-tombola-error]').textContent, 'storage');
    assert.equal(app.calls.filter((call) => call.url === '/spin').length, 0);
});
