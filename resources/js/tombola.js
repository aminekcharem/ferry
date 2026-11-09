document.addEventListener('DOMContentLoaded', async () => {
    document.querySelector('[data-tombola-reset]')?.addEventListener('submit', (event) => {
        if (!window.confirm('Autoriser tous les visiteurs à rejouer ? L’historique et le cycle seront conservés.')) event.preventDefault();
    });

    const root = document.querySelector('[data-tombola]');
    if (!root) return;
    const copy = JSON.parse(root.querySelector('[data-tombola-copy]').textContent);
    const dialog = root.querySelector('[data-tombola-dialog]');
    const launcher = root.querySelector('[data-tombola-open]');
    const form = root.querySelector('[data-tombola-form]');
    const submit = root.querySelector('[data-tombola-submit]');
    const output = root.querySelector('[data-tombola-result]');
    const error = root.querySelector('[data-tombola-error]');
    const locale = root.dataset.locale;
    const prefix = `yesmin-tombola:${location.host}:`;
    let state;
    let busy = false;
    let pending = null;
    let device;
    let canStore = true;
    let rotation = 0;
    const uuid = () => {
        const bytes = crypto.getRandomValues(new Uint8Array(16));
        bytes[6] = (bytes[6] & 15) | 64;
        bytes[8] = (bytes[8] & 63) | 128;
        const hex = [...bytes].map((byte) => byte.toString(16).padStart(2, '0')).join('');
        return `${hex.slice(0, 8)}-${hex.slice(8, 12)}-${hex.slice(12, 16)}-${hex.slice(16, 20)}-${hex.slice(20)}`;
    };
    const stored = (key) => {
        try { return localStorage.getItem(prefix + key); } catch { canStore = false; return null; }
    };
    const save = (key, value) => {
        try {
            if (value === null) localStorage.removeItem(prefix + key);
            else localStorage.setItem(prefix + key, value);
        } catch { canStore = false; }
    };
    const sessionGet = (key) => { try { return sessionStorage.getItem(prefix + key); } catch { return '1'; } };
    const sessionSet = (key) => { try { sessionStorage.setItem(prefix + key, '1'); } catch { /* Auto-open remains suppressed without session storage. */ } };
    const showError = (message) => { error.textContent = message; error.hidden = !message; };
    const request = async (url, data) => {
        const response = await fetch(url, {
            method: 'POST', credentials: 'omit', cache: 'no-store',
            headers: { 'Content-Type': 'application/json', Accept: 'application/json' },
            body: JSON.stringify(data), signal: AbortSignal.timeout(20000),
        });
        const body = await response.json().catch(() => ({}));
        if (!response.ok) throw Object.assign(new Error('Tombola request failed'), { status: response.status, body });
        return body;
    };
    const setBusy = (value) => {
        busy = value;
        form.setAttribute('aria-busy', String(value));
        submit.textContent = value ? copy.loading : copy.spin;
        [...form.elements].forEach((element) => { element.disabled = value; });
    };
    const displayResult = async (result, animate = false) => {
        form.hidden = true;
        output.hidden = true;
        showError('');
        // Nine 40-degree sectors repeat 20%, 30%, loss. Only the landing sector
        // is chosen here; the server has already determined the actual prize.
        const sector = { 20: 0, 30: 1, 0: 2 }[result.result] + 3 * Math.floor(Math.random() * 3);
        const angle = (360 - (sector * 40 + 20)) % 360;
        const target = Math.ceil(rotation / 360) * 360 + 1440 + angle;
        const wheel = root.querySelector('[data-tombola-wheel]');
        const duration = animate && !matchMedia('(prefers-reduced-motion: reduce)').matches ? 3000 : 0;
        if (duration) {
            const animation = wheel.animate([{ transform: `rotate(${rotation}deg)` }, { transform: `rotate(${target}deg)` }], { duration, easing: 'cubic-bezier(.15,.75,.15,1)', fill: 'forwards' });
            await animation.finished;
        } else {
            wheel.animate([{ transform: `rotate(${angle}deg)` }, { transform: `rotate(${angle}deg)` }], { duration: 1, fill: 'forwards' });
        }
        rotation = target;
        const headline = document.createElement('p');
        headline.className = 'text-xl font-bold text-primary-900';
        headline.textContent = result.result ? `${copy.win} ${result.result} ${copy.discount}` : copy.lose;
        output.replaceChildren(headline);
        if (result.result) {
            const notice = document.createElement('p');
            notice.className = 'mt-2 text-sm';
            notice.textContent = copy.sent;
            output.append(notice);
        }
        const next = document.createElement('p');
        next.className = 'mt-3 text-sm';
        next.textContent = `${copy.next} ${new Date(result.next_allowed_at).toLocaleString(locale)}`;
        output.append(next);
        output.hidden = false;
    };
    const open = () => {
        sessionSet(`dismissed:${state?.generation ?? 0}`);
        if (!dialog.open) dialog.showModal();
        if (!canStore) showError(copy.storage);
    };
    launcher.addEventListener('click', open);
    root.querySelector('[data-tombola-close]').addEventListener('click', () => dialog.close());
    dialog.addEventListener('close', () => launcher.focus());
    const clearErrors = () => {
        showError('');
        root.querySelectorAll('[data-tombola-field-error]').forEach((element) => { element.hidden = true; });
        form.querySelectorAll('[aria-invalid]').forEach((element) => element.removeAttribute('aria-invalid'));
    };
    const refresh = async () => {
        state = await request(root.dataset.statusUrl, { device_id: device });
        return state;
    };

    try {
        device = stored('device');
        if (!device || !/^[0-9a-f-]{36}$/i.test(device)) { device = uuid(); save('device', device); }
        try { pending = JSON.parse(stored('pending') || 'null'); } catch { save('pending', null); }
        await refresh();
        if (pending?.device_id === device) {
            const recovered = await request(root.dataset.resultUrl, { device_id: device, token: state.token, request_id: pending.request_id });
            if (recovered.previous) {
                pending = null;
                save('pending', null);
                launcher.hidden = false;
                await displayResult(recovered.previous);
            }
        }
        if (state.active) launcher.hidden = false;
        if (state.previous && !pending) await displayResult(state.previous);
        if (pending) {
            for (const field of ['first_name', 'last_name', 'email', 'phone']) form.elements[field].value = pending[field];
        }
        if (state.active && state.eligible && !sessionGet(`dismissed:${state.generation}`)) {
            setTimeout(() => {
                if (!document.querySelector('dialog[open]')) open();
            }, 3000);
        }
    } catch {
        // Booking remains usable when the optional campaign endpoint is unavailable.
        if (pending) { launcher.hidden = false; showError(copy.error); }
    }

    form.addEventListener('submit', async (event) => {
        event.preventDefault();
        if (busy) return;
        clearErrors();
        if (!canStore) { showError(copy.storage); return; }
        if (!form.reportValidity()) return;
        setBusy(true);
        try {
            await refresh();
            if (pending) {
                const recovered = await request(root.dataset.resultUrl, { device_id: device, token: state.token, request_id: pending.request_id });
                if (recovered.previous) {
                    pending = null;
                    save('pending', null);
                    await displayResult(recovered.previous, true);
                    return;
                }
            }
            if (!pending && !state.active) { showError(copy.inactive); return; }
            if (!pending) {
                pending = { device_id: device, request_id: uuid(), locale };
                for (const field of ['first_name', 'last_name', 'email', 'phone']) pending[field] = form.elements[field].value;
                save('pending', JSON.stringify(pending));
                if (!canStore) { pending = null; showError(copy.storage); return; }
            }
            const result = await request(root.dataset.spinUrl, { ...pending, token: state.token });
            pending = null;
            save('pending', null);
            await displayResult(result, true);
        } catch (exception) {
            if ([409, 422].includes(exception.status)) {
                // These responses prove that no new entry was accepted.
                pending = null;
                save('pending', null);
            }
            if (exception.status === 422) {
                const errors = exception.body.errors || {};
                if (errors.participation) {
                    const date = errors.participation[0].replace(/^24h: /, '');
                    showError(`${copy.blocked} ${copy.next} ${new Date(date).toLocaleString(locale)}`);
                } else {
                    showError(copy.invalid);
                    for (const field of ['first_name', 'last_name', 'email', 'phone']) {
                        if (!errors[field]) continue;
                        form.elements[field].setAttribute('aria-invalid', 'true');
                        const message = root.querySelector(`[data-tombola-field-error="${field}"]`);
                        message.textContent = copy.invalid;
                        message.hidden = false;
                    }
                }
            } else showError(({ 403: copy.token, 409: copy.inactive, 429: copy.rate })[exception.status] || copy.error);
        } finally {
            setBusy(false);
        }
    });
});
