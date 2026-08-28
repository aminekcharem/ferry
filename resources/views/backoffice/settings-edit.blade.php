<x-layouts.app title="Backoffice settings">
    <section class="ui-shell backoffice-surface py-8 lg:py-10">
        <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <span class="ui-badge"><x-icon name="settings" /> Configuration</span>
                <h1 class="mt-3 text-3xl font-bold text-slate-950">Backoffice settings</h1>
                <p class="mt-2 text-sm text-slate-600">Manage who receives ferry reservation email notifications.</p>
            </div>
            <a href="{{ route('dashboard') }}" class="ui-button-secondary">
                <x-icon name="chevron-left" />
                <span>Back to dashboard</span>
            </a>
        </div>

        @if (session('status'))
            <div class="mb-6 rounded-md border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-semibold text-emerald-800">
                {{ session('status') }}
            </div>
        @endif

        <div class="ui-card backoffice-card p-6">
            <form method="POST" action="{{ route('backoffice.settings.update') }}" class="grid gap-5">
                @csrf
                @method('PATCH')

                <div>
                    <label for="booking_notification_emails" class="ui-label">Notification emails</label>
                    <textarea id="booking_notification_emails" name="booking_notification_emails" rows="5" class="ui-input" placeholder="sales@example.com, manager@example.com">{{ old('booking_notification_emails', $bookingNotificationEmails) }}</textarea>
                    <p class="mt-2 text-sm text-slate-600">Separate multiple email addresses with commas.</p>
                    @error('booking_notification_emails')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>

                <div class="flex flex-wrap gap-2">
                    <button type="submit" class="ui-button-primary">
                        <x-icon name="save" />
                        <span>Save settings</span>
                    </button>
                    <a href="{{ route('dashboard') }}" class="ui-button-secondary">
                        <x-icon name="x" />
                        <span>Cancel</span>
                    </a>
                </div>
            </form>
        </div>
    </section>
</x-layouts.app>
