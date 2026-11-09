@props(['locale' => 'en'])
@php
    $copy = [
        'fr' => [
            'title' => 'Tentez votre chance !', 'intro' => 'Tournez la roue et tentez de gagner une réduction sur votre prochaine traversée.',
            'open' => 'Tourner la roue', 'close' => 'Fermer', 'lost' => 'Perdu', 'first_name' => 'Prénom', 'last_name' => 'Nom', 'email' => 'Email', 'phone' => 'Téléphone (avec indicatif pays)',
            'notice' => 'Tous les champs sont obligatoires. Une participation toutes les 24 h par navigateur, email ou téléphone. Vos coordonnées servent à enregistrer votre participation et à vous envoyer votre gain éventuel.',
            'spin' => 'Tourner la roue', 'loading' => 'Tirage en cours…', 'win' => 'Félicitations ! Vous avez gagné :', 'discount' => '% de réduction',
            'lose' => 'Pas de chance cette fois !', 'next' => 'Prochaine participation possible :', 'sent' => 'Votre gain est enregistré. Un email vous sera envoyé.',
            'error' => 'Connexion interrompue. Réessayez pour récupérer votre résultat sans nouveau tirage.', 'invalid' => 'Vérifiez les champs indiqués.', 'blocked' => 'Vous avez déjà participé au cours des dernières 24 heures.',
            'inactive' => 'La tombola est actuellement fermée.', 'token' => 'La session a expiré. Réessayez.', 'rate' => 'Trop de demandes. Veuillez patienter une minute.', 'storage' => 'Autorisez le stockage de ce navigateur pour participer.',
        ],
        'de' => [
            'title' => 'Versuchen Sie Ihr Glück!', 'intro' => 'Drehen Sie das Rad und gewinnen Sie mit etwas Glück einen Rabatt auf Ihre nächste Überfahrt.',
            'open' => 'Glücksrad drehen', 'close' => 'Schließen', 'lost' => 'Leider verloren', 'first_name' => 'Vorname', 'last_name' => 'Nachname', 'email' => 'E-Mail', 'phone' => 'Telefon (mit Landesvorwahl)',
            'notice' => 'Alle Felder sind Pflichtfelder. Eine Teilnahme pro 24 Stunden je Browser, E-Mail oder Telefon. Ihre Angaben dienen der Erfassung Ihrer Teilnahme und dem Versand eines möglichen Gewinns.',
            'spin' => 'Rad drehen', 'loading' => 'Ziehung läuft…', 'win' => 'Herzlichen Glückwunsch! Ihr Gewinn:', 'discount' => '% Rabatt',
            'lose' => 'Diesmal leider kein Gewinn!', 'next' => 'Nächste Teilnahme möglich:', 'sent' => 'Ihr Gewinn wurde gespeichert. Sie erhalten eine E-Mail.',
            'error' => 'Verbindung unterbrochen. Erneut versuchen, um Ihr Ergebnis ohne neue Ziehung abzurufen.', 'invalid' => 'Bitte prüfen Sie die markierten Felder.', 'blocked' => 'Sie haben in den letzten 24 Stunden bereits teilgenommen.',
            'inactive' => 'Das Gewinnspiel ist derzeit geschlossen.', 'token' => 'Die Sitzung ist abgelaufen. Bitte erneut versuchen.', 'rate' => 'Zu viele Anfragen. Bitte warten Sie eine Minute.', 'storage' => 'Bitte erlauben Sie die Speicherung im Browser, um teilzunehmen.',
        ],
        'en' => [
            'title' => 'Try your luck!', 'intro' => 'Spin the wheel for a chance to win a discount on your next crossing.',
            'open' => 'Spin the wheel', 'close' => 'Close', 'lost' => 'No prize', 'first_name' => 'First name', 'last_name' => 'Last name', 'email' => 'Email', 'phone' => 'Phone (with country code)',
            'notice' => 'All fields are required. One entry every 24 hours per browser, email or phone. Your details are used to record your entry and email you any prize.',
            'spin' => 'Spin the wheel', 'loading' => 'Drawing your result…', 'win' => 'Congratulations! You won:', 'discount' => '% discount',
            'lose' => 'No luck this time!', 'next' => 'You can play again:', 'sent' => 'Your prize has been recorded. An email will be sent to you.',
            'error' => 'Connection interrupted. Try again to retrieve your result without another draw.', 'invalid' => 'Please check the highlighted fields.', 'blocked' => 'You have already played within the last 24 hours.',
            'inactive' => 'The prize draw is currently closed.', 'token' => 'Your session has expired. Please try again.', 'rate' => 'Too many requests. Please wait a minute.', 'storage' => 'Please allow browser storage to participate.',
        ],
    ][$locale];
@endphp
<div data-tombola data-locale="{{ $locale }}" data-status-url="{{ route('tombola.status', absolute: false) }}" data-spin-url="{{ route('tombola.spin', absolute: false) }}" data-result-url="{{ route('tombola.result', absolute: false) }}">
    <script type="application/json" data-tombola-copy>@json($copy)</script>
    <button type="button" class="ui-button-primary tombola-launcher" data-tombola-open hidden>{{ $copy['open'] }}</button>
    <dialog class="ui-modal tombola-modal rounded-lg border border-primary-100 bg-white p-0 shadow-xl" data-tombola-dialog aria-labelledby="tombola-title" aria-describedby="tombola-intro">
        <div class="p-5 sm:p-7">
            <div class="flex items-start justify-between gap-3"><h2 id="tombola-title" class="text-2xl font-bold text-primary-900">{{ $copy['title'] }}</h2><button type="button" class="ui-button-secondary shrink-0" data-tombola-close aria-label="{{ $copy['close'] }}"><span aria-hidden="true">×</span></button></div>
            <p id="tombola-intro" class="mt-2 text-sm text-slate-600">{{ $copy['intro'] }}</p>
            <div class="tombola-wheel-wrap" aria-hidden="true">
                <div class="tombola-pointer"></div>
                <svg class="tombola-wheel" data-tombola-wheel viewBox="0 0 300 300">
                    <circle cx="150" cy="150" r="145" fill="#ffffff" />
                    @foreach ([20, 30, 0, 20, 30, 0, 20, 30, 0] as $index => $outcome)
                        @php
                            $start = deg2rad($index * 40);
                            $end = deg2rad(($index + 1) * 40);
                            $center = $index * 40 + 20;
                            $labelX = 150 + 96 * sin(deg2rad($center));
                            $labelY = 150 - 96 * cos(deg2rad($center));
                            $labelRotation = $center > 180 ? $center + 90 : $center - 90;
                        @endphp
                        <path data-tombola-sector="{{ $outcome }}" d="M150 150 L{{ 150 + 140 * sin($start) }} {{ 150 - 140 * cos($start) }} A140 140 0 0 1 {{ 150 + 140 * sin($end) }} {{ 150 - 140 * cos($end) }} Z" fill="{{ [20 => '#0096d6', 30 => '#005f8a', 0 => '#e2e8f0'][$outcome] }}" stroke="#ffffff" stroke-width="1" />
                        <text x="{{ $labelX }}" y="{{ $labelY }}" transform="rotate({{ $labelRotation }} {{ $labelX }} {{ $labelY }})" text-anchor="middle" dominant-baseline="middle" class="tombola-wheel-label {{ $outcome ? 'tombola-wheel-label-light' : 'tombola-wheel-label-dark tombola-wheel-label-small' }}">{{ $outcome ? $outcome.' %' : $copy['lost'] }}</text>
                    @endforeach
                    <circle cx="150" cy="150" r="22" fill="white" stroke="#b8e9ff" stroke-width="4" />
                </svg>
            </div>
            <p class="mb-4 text-center text-sm font-semibold text-slate-600">20 % · 30 % · {{ $copy['lost'] }}</p>
            <div role="status" aria-live="polite" data-tombola-result class="ui-panel mb-4 p-4 text-center" hidden></div>
            <p role="alert" data-tombola-error class="mb-4 text-sm font-semibold text-red-700" hidden></p>
            <form data-tombola-form class="grid gap-4">
                <div class="grid gap-4 sm:grid-cols-2">
                    @foreach (['last_name', 'first_name', 'email', 'phone'] as $field)
                        <div><label class="ui-label" for="tombola-{{ $field }}">{{ $copy[$field] }}</label><input id="tombola-{{ $field }}" class="ui-input" name="{{ $field }}" type="{{ $field === 'email' ? 'email' : ($field === 'phone' ? 'tel' : 'text') }}" autocomplete="{{ ['last_name' => 'family-name', 'first_name' => 'given-name', 'email' => 'email', 'phone' => 'tel'][$field] }}" maxlength="{{ $field === 'phone' ? 40 : ($field === 'email' ? 255 : 100) }}" aria-describedby="tombola-error-{{ $field }}" required><p id="tombola-error-{{ $field }}" data-tombola-field-error="{{ $field }}" class="mt-1 text-sm text-red-700" hidden></p></div>
                    @endforeach
                </div>
                <p class="text-xs leading-relaxed text-slate-500">{{ $copy['notice'] }}</p>
                <button type="submit" class="ui-button-primary w-full" data-tombola-submit>{{ $copy['spin'] }}</button>
            </form>
        </div>
    </dialog>
</div>
