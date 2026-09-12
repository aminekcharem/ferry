@php
    $locale = in_array($locale ?? request()->route('locale'), ['en', 'fr', 'de'], true) ? ($locale ?? request()->route('locale')) : 'en';
    $translations = [
        'en' => [
            'title' => 'Ferry Reservation',
            'success_message' => 'Your ferry reservation request has been sent.',
            'badge' => 'Booking Form',
            'heading' => 'Ferry reservation with vehicle',
            'intro' => 'Enter the itinerary, passengers, and vehicle information. Passenger details appear automatically based on the selected quantities.',
            'success_title' => 'Request sent',
            'success_body' => 'Our team will review the reservation details and contact you shortly.',
            'done' => 'Done',
            'check_form' => 'Please check the form information.',
            'website' => 'Website',
            'client' => 'Client',
            'client_help' => 'Contact details used to follow up with the requester.',
            'full_name' => 'Full name',
            'email' => 'Email',
            'phone' => 'Phone',
            'message' => 'Message',
            'itinerary' => 'Itinerary',
            'itinerary_help' => 'Trip type, departure country, and dates.',
            'favorite_company' => 'Favorite ferry company',
            'choose' => 'Choose',
            'trip_type' => 'Trip type',
            'one_way' => 'One way',
            'round_trip' => 'Round trip',
            'departure_country' => 'Departure country',
            'return_country' => 'Return country',
            'same_return' => 'Same return destination',
            'select' => 'Select',
            'outward_date' => 'Outward date',
            'return_date' => 'Return date',
            'passengers' => 'Passengers',
            'passengers_help' => 'Adjust quantities by category.',
            'outward' => 'Outward',
            'return' => 'Return',
            'remove_passenger' => 'Remove passenger',
            'add_passenger' => 'Add passenger',
            'remove_return_passenger' => 'Remove return passenger',
            'add_return_passenger' => 'Add return passenger',
            'passenger_details' => 'Passenger details',
            'vehicle' => 'Vehicle',
            'vehicle_help' => 'Technical information and owner details.',
            'brand' => 'Brand',
            'model' => 'Model',
            'model_year' => 'Model year',
            'select_year' => 'Select year',
            'manual_year' => 'Enter model year manually',
            'enter_model_year' => 'Enter model year',
            'other_brand' => 'Other brand',
            'other_model' => 'Other model',
            'custom_dimensions' => 'Vehicle dimensions differ from the standard values',
            'length' => 'Length',
            'height' => 'Height',
            'width' => 'Width',
            'roof_box' => 'Roof box',
            'roof_extra_question' => 'Something on the roof, e.g. roof box etc?',
            'extra_height' => 'Extra height',
            'back_extra_question' => 'Something on the back, e.g. bikes, luggage etc?',
            'extra_length' => 'Extra length',
            'up_to_05' => 'up to 0.5 m',
            'up_to_100' => 'up to 1.00 m',
            'trailer_reservation' => 'Trailer reservation',
            'trailer_type' => 'Trailer type',
            'trailer' => 'Trailer',
            'boat_trailer' => 'Boat trailer',
            'caravan' => 'Caravan',
            'trailer_length' => 'Trailer length',
            'trailer_height' => 'Trailer height',
            'trailer_width' => 'Trailer width',
            'trailer_license' => 'Trailer license plate',
            'trailer_owner' => 'Trailer owner',
            'license_plate' => 'License plate',
            'owner' => 'Owner',
            'height_confirmation' => 'Vehicle height confirmation',
            'height_warning' => 'The height must be accurate. An error may lead to additional port fees or boarding refusal.',
            'height_acceptance' => 'I confirm that the vehicle height has been entered correctly.',
            'send' => 'Send ferry request',
            'sending' => 'Sending request...',
            'routes' => [
                'Tunisia - Gênes',
                'Tunisia - Civitavecchia',
                'Tunisia - Palerme (Sicile)',
                'Tunisia - Marseille',
                'Gênes - Tunisia',
                'Civitavecchia - Tunisia',
                'Palerme (Sicile) - Tunisia',
                'Marseille - Tunisia',
            ],
            'passenger_categories' => [
                'Senior (60 to 102 years)',
                'Adult(s) (25 to 60 years)',
                'Youth (15 to 25 years)',
                'Child (02 to 15 years)',
                'Baby/Babies (01 to 02 years)',
                'Newborn(s) (0 to 01 years)',
            ],
            'js' => [
                'fieldFallback' => 'This field',
                'required' => '{label} is required.',
                'typeMismatch' => 'Enter a valid value for {label}.',
                'patternMismatch' => '{label} has an invalid format.',
                'rangeUnderflow' => '{label} must be greater than or equal to {min}.',
                'rangeOverflow' => '{label} must be less than or equal to {max}.',
                'stepMismatch' => '{label} must match the requested step.',
                'tooLong' => '{label} is too long.',
                'invalid' => '{label} is invalid.',
                'laterDate' => 'Choose a later date.',
                'earlierDate' => 'Choose an earlier date.',
                'returnDateOrder' => 'The return date must be after or equal to the outward date.',
                'select' => 'Select',
                'male' => 'Male',
                'female' => 'Female',
                'willReturn' => 'Will this outward passenger return?',
                'yes' => 'Yes',
                'no' => 'No',
                'returnPassengerLastName' => 'Return passenger last name',
                'returnPassengerFirstName' => 'Return passenger first name',
                'returnPassengerDateOfBirth' => 'Return passenger date of birth',
                'returnPassengerGender' => 'Return passenger gender',
                'returnPassengerPassportNumber' => 'Return passenger passport number',
                'returnPassengerPassportAvailabilityDate' => 'Return passenger passport availability date',
                'outwardTitle' => 'Outward - {category} #{number}',
                'returnOnlyTitle' => 'Return only - {category} #{number}',
                'lastName' => 'Last name',
                'firstName' => 'First name',
                'dateOfBirth' => 'Date of birth',
                'gender' => 'Gender',
                'passportNumber' => 'Passport number',
                'passportAvailabilityDate' => 'Passport availability date',
                'selectYear' => 'Select year',
                'yearNotFound' => 'Year not found',
                'searchingYears' => 'Searching years...',
                'selectBrand' => 'Select brand',
                'selectModel' => 'Select model',
                'other' => 'Other',
            ],
        ],
        'fr' => [
            'title' => 'Reservation Ferry',
            'success_message' => 'Votre demande de reservation ferry a bien ete envoyee.',
            'badge' => 'Formulaire de reservation',
            'heading' => 'Reservation ferry avec vehicule',
            'intro' => 'Renseignez l itineraire, les passagers et les informations du vehicule. Les details des passagers apparaissent automatiquement selon les quantites choisies.',
            'success_title' => 'Demande envoyee',
            'success_body' => 'Notre equipe verifiera les details de la reservation et vous contactera rapidement.',
            'done' => 'Termine',
            'check_form' => 'Veuillez verifier les informations du formulaire.',
            'website' => 'Site web',
            'client' => 'Client',
            'client_help' => 'Coordonnees utilisees pour recontacter le demandeur.',
            'full_name' => 'Nom complet',
            'email' => 'E-mail',
            'phone' => 'Telephone',
            'message' => 'Message',
            'itinerary' => 'Itineraire',
            'itinerary_help' => 'Type de trajet, pays de depart et dates.',
            'favorite_company' => 'Compagnie ferry preferee',
            'choose' => 'Choisir',
            'trip_type' => 'Type de trajet',
            'one_way' => 'Aller simple',
            'round_trip' => 'Aller-retour',
            'departure_country' => 'Pays de depart',
            'return_country' => 'Pays de retour',
            'same_return' => 'Meme destination de retour',
            'select' => 'Selectionner',
            'outward_date' => 'Date aller',
            'return_date' => 'Date retour',
            'passengers' => 'Passagers',
            'passengers_help' => 'Ajustez les quantites par categorie.',
            'outward' => 'Aller',
            'return' => 'Retour',
            'remove_passenger' => 'Retirer un passager',
            'add_passenger' => 'Ajouter un passager',
            'remove_return_passenger' => 'Retirer un passager retour',
            'add_return_passenger' => 'Ajouter un passager retour',
            'passenger_details' => 'Details des passagers',
            'vehicle' => 'Vehicule',
            'vehicle_help' => 'Informations techniques et coordonnees du proprietaire.',
            'brand' => 'Marque',
            'model' => 'Modele',
            'model_year' => 'Annee du modele',
            'select_year' => 'Selectionner une annee',
            'manual_year' => 'Saisir l annee du modele manuellement',
            'enter_model_year' => 'Saisir l annee du modele',
            'other_brand' => 'Autre marque',
            'other_model' => 'Autre modele',
            'custom_dimensions' => 'Les dimensions du vehicule different des valeurs standard',
            'length' => 'Longueur',
            'height' => 'Hauteur',
            'width' => 'Largeur',
            'roof_box' => 'Coffre de toit',
            'roof_extra_question' => 'Element sur le toit, par exemple coffre de toit ?',
            'extra_height' => 'Hauteur supplementaire',
            'back_extra_question' => 'Element a l arriere, par exemple velos ou bagages ?',
            'extra_length' => 'Longueur supplementaire',
            'up_to_05' => 'jusqu a 0,5 m',
            'up_to_100' => 'jusqu a 1,00 m',
            'trailer_reservation' => 'Reservation remorque',
            'trailer_type' => 'Type de remorque',
            'trailer' => 'Remorque',
            'boat_trailer' => 'Remorque bateau',
            'caravan' => 'Caravane',
            'trailer_length' => 'Longueur remorque',
            'trailer_height' => 'Hauteur remorque',
            'trailer_width' => 'Largeur remorque',
            'trailer_license' => 'Immatriculation remorque',
            'trailer_owner' => 'Proprietaire remorque',
            'license_plate' => 'Immatriculation',
            'owner' => 'Proprietaire',
            'height_confirmation' => 'Confirmation de la hauteur du vehicule',
            'height_warning' => 'La hauteur doit etre exacte. Une erreur peut entrainer des frais portuaires supplementaires ou un refus d embarquement.',
            'height_acceptance' => 'Je confirme que la hauteur du vehicule a ete saisie correctement.',
            'send' => 'Envoyer la demande ferry',
            'sending' => 'Envoi de la demande...',
            'routes' => [
                'Tunisie - Genève',
                'Tunisie - Civitavecchia',
                'Tunisie - Palerme (Sicile)',
                'Tunisie - Marseille',
                'Genève - Tunisie',
                'Civitavecchia - Tunisie',
                'Palerme (Sicile) - Tunisie',
                'Marseille - Tunisie',
            ],
            'passenger_categories' => [
                'Senior (60 a 102 ans)',
                'Adulte(s) (25 a 60 ans)',
                'Jeune (15 a 25 ans)',
                'Enfant (02 a 15 ans)',
                'Bebe(s) (01 a 02 ans)',
                'Nouveau-ne(s) (0 a 01 an)',
            ],
            'js' => [
                'fieldFallback' => 'Ce champ',
                'required' => '{label} est obligatoire.',
                'typeMismatch' => 'Saisissez une valeur valide pour {label}.',
                'patternMismatch' => '{label} a un format invalide.',
                'rangeUnderflow' => '{label} doit etre superieur ou egal a {min}.',
                'rangeOverflow' => '{label} doit etre inferieur ou egal a {max}.',
                'stepMismatch' => '{label} doit respecter le pas demande.',
                'tooLong' => '{label} est trop long.',
                'invalid' => '{label} est invalide.',
                'laterDate' => 'Choisissez une date ulterieure.',
                'earlierDate' => 'Choisissez une date anterieure.',
                'returnDateOrder' => 'La date retour doit etre posterieure ou egale a la date aller.',
                'select' => 'Selectionner',
                'male' => 'Homme',
                'female' => 'Femme',
                'willReturn' => 'Ce passager aller reviendra-t-il ?',
                'yes' => 'Oui',
                'no' => 'Non',
                'returnPassengerLastName' => 'Nom du passager retour',
                'returnPassengerFirstName' => 'Prenom du passager retour',
                'returnPassengerDateOfBirth' => 'Date de naissance du passager retour',
                'returnPassengerGender' => 'Sexe du passager retour',
                'returnPassengerPassportNumber' => 'Numero de passeport du passager retour',
                'returnPassengerPassportAvailabilityDate' => 'Date de disponibilite du passeport du passager retour',
                'outwardTitle' => 'Aller - {category} #{number}',
                'returnOnlyTitle' => 'Retour uniquement - {category} #{number}',
                'lastName' => 'Nom',
                'firstName' => 'Prenom',
                'dateOfBirth' => 'Date de naissance',
                'gender' => 'Sexe',
                'passportNumber' => 'Numero de passeport',
                'passportAvailabilityDate' => 'Date de disponibilite du passeport',
                'selectYear' => 'Selectionner une annee',
                'yearNotFound' => 'Annee introuvable',
                'searchingYears' => 'Recherche des annees...',
                'selectBrand' => 'Selectionner une marque',
                'selectModel' => 'Selectionner un modele',
                'other' => 'Autre',
            ],
        ],
        'de' => [
            'title' => 'Faehrreservierung',
            'success_message' => 'Ihre Faehrreservierungsanfrage wurde gesendet.',
            'badge' => 'Buchungsformular',
            'heading' => 'Faehrreservierung mit Fahrzeug',
            'intro' => 'Geben Sie Route, Passagiere und Fahrzeuginformationen ein. Passagierdetails erscheinen automatisch entsprechend der gewaehlten Anzahl.',
            'success_title' => 'Anfrage gesendet',
            'success_body' => 'Unser Team prueft die Reservierungsdetails und kontaktiert Sie in Kuerze.',
            'done' => 'Fertig',
            'check_form' => 'Bitte pruefen Sie die Formularangaben.',
            'website' => 'Webseite',
            'client' => 'Kunde',
            'client_help' => 'Kontaktdaten, mit denen wir den Anfragenden erreichen.',
            'full_name' => 'Vollstaendiger Name',
            'email' => 'E-Mail',
            'phone' => 'Telefon',
            'message' => 'Nachricht',
            'itinerary' => 'Route',
            'itinerary_help' => 'Reiseart, Abfahrtsland und Daten.',
            'favorite_company' => 'Bevorzugte Faehrgesellschaft',
            'choose' => 'Auswaehlen',
            'trip_type' => 'Reiseart',
            'one_way' => 'Einfache Fahrt',
            'round_trip' => 'Hin- und Rueckfahrt',
            'departure_country' => 'Abfahrtsland',
            'return_country' => 'Rueckfahrtsland',
            'same_return' => 'Gleiches Rueckreiseziel',
            'select' => 'Auswaehlen',
            'outward_date' => 'Hinreisedatum',
            'return_date' => 'Rueckreisedatum',
            'passengers' => 'Passagiere',
            'passengers_help' => 'Passen Sie die Anzahl pro Kategorie an.',
            'outward' => 'Hinfahrt',
            'return' => 'Rueckfahrt',
            'remove_passenger' => 'Passagier entfernen',
            'add_passenger' => 'Passagier hinzufuegen',
            'remove_return_passenger' => 'Rueckfahrt-Passagier entfernen',
            'add_return_passenger' => 'Rueckfahrt-Passagier hinzufuegen',
            'passenger_details' => 'Passagierdetails',
            'vehicle' => 'Fahrzeug',
            'vehicle_help' => 'Technische Angaben und Halterdaten.',
            'brand' => 'Marke',
            'model' => 'Modell',
            'model_year' => 'Modelljahr',
            'select_year' => 'Jahr auswaehlen',
            'manual_year' => 'Modelljahr manuell eingeben',
            'enter_model_year' => 'Modelljahr eingeben',
            'other_brand' => 'Andere Marke',
            'other_model' => 'Anderes Modell',
            'custom_dimensions' => 'Fahrzeugabmessungen weichen von den Standardwerten ab',
            'length' => 'Laenge',
            'height' => 'Hoehe',
            'width' => 'Breite',
            'roof_box' => 'Dachbox',
            'roof_extra_question' => 'Etwas auf dem Dach, z. B. Dachbox?',
            'extra_height' => 'Zusaetzliche Hoehe',
            'back_extra_question' => 'Etwas am Heck, z. B. Fahrraeder oder Gepaeck?',
            'extra_length' => 'Zusaetzliche Laenge',
            'up_to_05' => 'bis 0,5 m',
            'up_to_100' => 'bis 1,00 m',
            'trailer_reservation' => 'Anhaengerreservierung',
            'trailer_type' => 'Anhaengertyp',
            'trailer' => 'Anhaenger',
            'boat_trailer' => 'Bootsanhaenger',
            'caravan' => 'Wohnwagen',
            'trailer_length' => 'Anhaengerlaenge',
            'trailer_height' => 'Anhaengerhoehe',
            'trailer_width' => 'Anhaengerbreite',
            'trailer_license' => 'Anhaengerkennzeichen',
            'trailer_owner' => 'Anhaengerhalter',
            'license_plate' => 'Kennzeichen',
            'owner' => 'Halter',
            'height_confirmation' => 'Bestaetigung der Fahrzeughoehe',
            'height_warning' => 'Die Hoehe muss exakt sein. Ein Fehler kann zu zusaetzlichen Hafengebuehren oder zur Verweigerung der Einschiffung fuehren.',
            'height_acceptance' => 'Ich bestaetige, dass die Fahrzeughoehe korrekt eingegeben wurde.',
            'send' => 'Faehranfrage senden',
            'sending' => 'Anfrage wird gesendet...',
            'routes' => [
                'Tunesien - Genua',
                'Tunesien - Civitavecchia',
                'Tunesien - Palermo (Sizilien)',
                'Tunesien - Marseille',
                'Genua - Tunesien',
                'Civitavecchia - Tunesien',
                'Palermo (Sizilien) - Tunesien',
                'Marseille - Tunesien',
            ],
            'passenger_categories' => [
                'Senior (60 bis 102 Jahre)',
                'Erwachsene(r) (25 bis 60 Jahre)',
                'Jugendliche(r) (15 bis 25 Jahre)',
                'Kind (02 bis 15 Jahre)',
                'Baby(s) (01 bis 02 Jahre)',
                'Neugeborene(s) (0 bis 01 Jahr)',
            ],
            'js' => [
                'fieldFallback' => 'Dieses Feld',
                'required' => '{label} ist erforderlich.',
                'typeMismatch' => 'Geben Sie einen gueltigen Wert fuer {label} ein.',
                'patternMismatch' => '{label} hat ein ungueltiges Format.',
                'rangeUnderflow' => '{label} muss groesser oder gleich {min} sein.',
                'rangeOverflow' => '{label} muss kleiner oder gleich {max} sein.',
                'stepMismatch' => '{label} muss dem geforderten Schritt entsprechen.',
                'tooLong' => '{label} ist zu lang.',
                'invalid' => '{label} ist ungueltig.',
                'laterDate' => 'Waehlen Sie ein spaeteres Datum.',
                'earlierDate' => 'Waehlen Sie ein frueheres Datum.',
                'returnDateOrder' => 'Das Rueckreisedatum muss nach oder am Hinreisedatum liegen.',
                'select' => 'Auswaehlen',
                'male' => 'Maennlich',
                'female' => 'Weiblich',
                'willReturn' => 'Kehrt dieser Hinreise-Passagier zurueck?',
                'yes' => 'Ja',
                'no' => 'Nein',
                'returnPassengerLastName' => 'Nachname des Rueckfahrt-Passagiers',
                'returnPassengerFirstName' => 'Vorname des Rueckfahrt-Passagiers',
                'returnPassengerDateOfBirth' => 'Geburtsdatum des Rueckfahrt-Passagiers',
                'returnPassengerGender' => 'Geschlecht des Rueckfahrt-Passagiers',
                'returnPassengerPassportNumber' => 'Passnummer des Rueckfahrt-Passagiers',
                'returnPassengerPassportAvailabilityDate' => 'Verfuegbarkeitsdatum des Passes des Rueckfahrt-Passagiers',
                'outwardTitle' => 'Hinfahrt - {category} #{number}',
                'returnOnlyTitle' => 'Nur Rueckfahrt - {category} #{number}',
                'lastName' => 'Nachname',
                'firstName' => 'Vorname',
                'dateOfBirth' => 'Geburtsdatum',
                'gender' => 'Geschlecht',
                'passportNumber' => 'Passnummer',
                'passportAvailabilityDate' => 'Verfuegbarkeitsdatum des Passes',
                'selectYear' => 'Jahr auswaehlen',
                'yearNotFound' => 'Jahr nicht gefunden',
                'searchingYears' => 'Modelljahre werden gesucht...',
                'selectBrand' => 'Marke auswaehlen',
                'selectModel' => 'Modell auswaehlen',
                'other' => 'Andere',
            ],
        ],
    ];

    $t = $translations[$locale];
    $reservationSuccessMessage = session('status')
        ?: (request()->boolean('reservation_sent') ? $t['success_message'] : null);

    $htmlDate = function (?string $value): string {
        if (blank($value)) {
            return '';
        }

        foreach (['Y-m-d', 'd/m/Y'] as $format) {
            try {
                $date = \Carbon\CarbonImmutable::createFromFormat('!' . $format, $value);
            } catch (\InvalidArgumentException) {
                continue;
            }

            if ($date->format($format) === $value) {
                return $date->format('Y-m-d');
            }
        }

        return '';
    };

    $formRouteParameters = array_filter([
        'locale' => $locale,
        'embed' => request()->boolean('embed') ? 1 : null,
    ]);
    $formRoute = $locale === 'en'
        ? route('reservation.ctn.store', array_filter(['embed' => request()->boolean('embed') ? 1 : null]))
        : route('reservation.ctn.store.localized', $formRouteParameters);
@endphp

<x-layouts.app :title="$t['title']" :lang="$locale">
    <section class="ui-shell py-8 lg:py-10">
        <div class="mb-6">
            <span class="ui-badge">{{ $t['badge'] }}</span>
            <h1 class="mt-3 text-3xl font-bold text-slate-950">{{ $t['heading'] }}</h1>
            <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-600">{{ $t['intro'] }}</p>
        </div>

        @if ($reservationSuccessMessage)
            <dialog class="ui-modal reservation-success-modal w-[min(92vw,28rem)] rounded-lg border border-emerald-100 bg-white p-0 text-left shadow-xl" data-reservation-success-modal aria-labelledby="reservation-success-title">
                <div class="relative overflow-hidden p-6 text-center sm:p-7">
                    <button type="button" class="absolute right-3 top-3 inline-flex h-9 w-9 items-center justify-center rounded-md text-slate-500 transition hover:bg-slate-100 hover:text-slate-800" data-reservation-success-close aria-label="{{ $t['done'] }}">
                        <x-icon name="x" class="h-5 w-5" />
                    </button>

                    <div class="reservation-success-icon mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-emerald-50 text-emerald-600 ring-8 ring-emerald-50/70">
                        <x-icon name="check" class="h-8 w-8" />
                    </div>

                    <h2 id="reservation-success-title" class="mt-5 text-xl font-bold text-slate-950">{{ $t['success_title'] }}</h2>
                    <p class="mt-3 text-sm font-semibold leading-6 text-emerald-700">
                        {{ $reservationSuccessMessage }}
                    </p>
                    <p class="mt-2 text-sm leading-6 text-slate-600">
                        {{ $t['success_body'] }}
                    </p>

                    <button type="button" class="ui-button-primary mt-6 w-full" data-reservation-success-close>
                        <x-icon name="check" />
                        <span>{{ $t['done'] }}</span>
                    </button>
                </div>
            </dialog>
        @endif

        @if ($errors->any())
            <div class="mb-6 rounded-md border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                <p class="font-semibold">{{ $t['check_form'] }}</p>
                <ul class="mt-2 list-disc space-y-1 pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form id="ctn-reservation-form" action="{{ $formRoute }}" method="POST" class="space-y-6">
            @csrf
            <div class="sr-only" aria-hidden="true">
                <label for="booking_website">{{ $t['website'] }}</label>
                <input id="booking_website" name="booking_website" type="text" value="" tabindex="-1" autocomplete="off">
            </div>

            <div class="grid gap-6 lg:grid-cols-[1fr_380px]">
                <div class="space-y-6">
                    <section class="ui-card p-5">
                        <div class="flex items-start gap-3">
                            <span class="ui-step">1</span>
                            <div>
                                <h2 class="text-xl font-bold text-slate-950">{{ $t['client'] }}</h2>
                                <p class="mt-1 text-sm text-slate-600">{{ $t['client_help'] }}</p>
                            </div>
                        </div>
                        <div class="mt-5 grid gap-4 sm:grid-cols-2">
                            <div>
                                <label for="customer_name" class="ui-label">{{ $t['full_name'] }} <span class="text-red-600" aria-hidden="true">*</span></label>
                                <input id="customer_name" name="customer_name" type="text" value="{{ old('customer_name') }}" required autocomplete="name" class="ui-input">
                                @error('customer_name')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label for="customer_email" class="ui-label">{{ $t['email'] }} <span class="text-red-600" aria-hidden="true">*</span></label>
                                <input id="customer_email" name="customer_email" type="email" value="{{ old('customer_email') }}" required autocomplete="email" class="ui-input">
                                @error('customer_email')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label for="customer_phone" class="ui-label">{{ $t['phone'] }} <span class="text-red-600" aria-hidden="true">*</span></label>
                                <input id="customer_phone" name="customer_phone" type="text" value="{{ old('customer_phone') }}" required autocomplete="tel" class="ui-input">
                                @error('customer_phone')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label for="customer_message" class="ui-label">{{ $t['message'] }}</label>
                                <textarea id="customer_message" name="customer_message" rows="3" class="ui-input">{{ old('customer_message') }}</textarea>
                                @error('customer_message')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                            </div>
                        </div>
                    </section>

                    <section class="ui-card p-5">
                        <div class="flex items-start gap-3">
                            <span class="ui-step">2</span>
                            <div>
                                <h2 class="text-xl font-bold text-slate-950">{{ $t['itinerary'] }}</h2>
                                <p class="mt-1 text-sm text-slate-600">{{ $t['itinerary_help'] }}</p>
                            </div>
                        </div>
                        <div class="mt-5 space-y-5">
                            <div>
                                <label for="favorite_ferry_company" class="ui-label">{{ $t['favorite_company'] }} <span class="text-red-600" aria-hidden="true">*</span></label>
                                <select id="favorite_ferry_company" name="favorite_ferry_company" required class="ui-input">
                                    <option value="">{{ $t['choose'] }}</option>
                                    @foreach (['CTN', 'GNV'] as $company)
                                        <option value="{{ $company }}" @selected(old('favorite_ferry_company') === $company)>{{ $company }}</option>
                                    @endforeach
                                </select>
                                @error('favorite_ferry_company')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                            </div>

                            <div>
                                <p class="ui-label">{{ $t['trip_type'] }} <span class="text-red-600" aria-hidden="true">*</span></p>
                                <div class="mt-2 grid gap-3 sm:grid-cols-2">
                                    <label class="flex min-h-12 cursor-pointer items-center justify-center rounded-md border border-slate-300 bg-white px-4 py-3 text-sm font-semibold text-slate-800 transition has-[:checked]:border-primary has-[:checked]:bg-primary has-[:checked]:text-white">
                                        <input type="radio" name="journey_type" value="one_way" class="sr-only" @checked(old('journey_type', 'one_way') === 'one_way')>
                                        {{ $t['one_way'] }}
                                    </label>
                                    <label class="flex min-h-12 cursor-pointer items-center justify-center rounded-md border border-slate-300 bg-white px-4 py-3 text-sm font-semibold text-slate-800 transition has-[:checked]:border-primary has-[:checked]:bg-primary has-[:checked]:text-white">
                                        <input type="radio" name="journey_type" value="round_trip" class="sr-only" @checked(old('journey_type') === 'round_trip')>
                                        {{ $t['round_trip'] }}
                                    </label>
                                </div>
                            </div>

                            <div>
                                <label for="departure_country" class="ui-label">{{ $t['departure_country'] }} <span class="text-red-600" aria-hidden="true">*</span></label>
                                <select id="departure_country" name="departure_country" required class="ui-input">
                                    <option value="">{{ $t['select'] }}</option>
                                    @foreach ($t['routes'] as $route)
                                        <option value="{{ $route }}" @selected(old('departure_country') === $route)>{{ $route }}</option>
                                    @endforeach
                                </select>
                                @error('departure_country')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                            </div>

                            <div data-return-country>
                                <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                                    <label for="return_country" class="ui-label">{{ $t['return_country'] }} <span class="text-red-600" aria-hidden="true">*</span></label>
                                    <label class="inline-flex items-center gap-2 text-sm font-semibold text-slate-700">
                                        <input type="checkbox" class="h-4 w-4 rounded border-slate-300 text-primary focus:ring-primary-100" data-same-return-destination>
                                        <span>{{ $t['same_return'] }}</span>
                                    </label>
                                </div>
                                <input type="hidden" name="return_country" value="" disabled data-return-country-hidden>
                                <select id="return_country" name="return_country" class="ui-input">
                                    <option value="">{{ $t['select'] }}</option>
                                    @foreach ($t['routes'] as $route)
                                        <option value="{{ $route }}" @selected(old('return_country') === $route)>{{ $route }}</option>
                                    @endforeach
                                </select>
                                @error('return_country')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                            </div>

                            <div class="grid gap-4 sm:grid-cols-2">
                                <div>
                                    <label for="outward_date" class="ui-label">{{ $t['outward_date'] }} <span class="text-red-600" aria-hidden="true">*</span></label>
                                    <input id="outward_date" name="outward_date" type="date" value="{{ $htmlDate(old('outward_date')) }}" required data-travel-date class="ui-input">
                                    @error('outward_date')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                                </div>
                                <div data-return-date>
                                    <label for="return_date" class="ui-label">{{ $t['return_date'] }} <span class="text-red-600" aria-hidden="true">*</span></label>
                                    <input id="return_date" name="return_date" type="date" value="{{ $htmlDate(old('return_date')) }}" data-travel-date class="ui-input">
                                    @error('return_date')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="ui-card p-5">
                        <div class="flex items-start gap-3">
                            <span class="ui-step">3</span>
                            <div class="flex-1">
                                <div class="flex flex-col gap-3 sm:flex-row sm:items-start sm:justify-between">
                                    <div>
                                        <h2 class="text-xl font-bold text-slate-950">{{ $t['passengers'] }}</h2>
                                        <p class="mt-1 text-sm text-slate-600">{{ $t['passengers_help'] }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-5 divide-y divide-slate-200 overflow-hidden rounded-lg border border-slate-200">
                            <div class="hidden bg-white px-3 pt-3 sm:grid sm:grid-cols-[1fr_auto_auto] sm:items-center sm:gap-3">
                                <span aria-hidden="true"></span>
                                <span class="w-36 text-center text-xs font-bold uppercase text-slate-500">{{ $t['outward'] }}</span>
                                <span data-return-column-label class="w-36 text-center text-xs font-bold uppercase text-slate-500">{{ $t['return'] }}</span>
                            </div>
                            @foreach ($t['passenger_categories'] as $passenger)
                                <div class="grid gap-3 bg-white p-3 sm:grid-cols-[1fr_auto_auto] sm:items-center" data-passenger-row data-passenger-category="{{ $passenger }}">
                                    <span class="text-sm font-semibold text-slate-800">{{ $passenger }}</span>
                                    <div class="grid grid-cols-[minmax(4.5rem,1fr)_auto] items-center gap-3 sm:block" data-passenger-direction="outward">
                                        <span class="text-xs font-bold uppercase text-slate-500 sm:sr-only">{{ $t['outward'] }}</span>
                                        <div class="flex items-center gap-2">
                                            <button type="button" data-counter-minus class="h-9 w-9 rounded-md border border-slate-300 text-lg font-bold text-slate-600 hover:bg-slate-100" aria-label="{{ $t['remove_passenger'] }}">-</button>
                                            <input type="number" name="outward_passengers[]" min="0" value="{{ old('outward_passengers.' . $loop->index, 0) }}" class="h-9 w-14 rounded-md border border-slate-300 text-center text-sm font-bold text-slate-950">
                                            <button type="button" data-counter-plus class="h-9 w-9 rounded-md bg-primary text-lg font-bold text-white hover:bg-primary-700" aria-label="{{ $t['add_passenger'] }}">+</button>
                                        </div>
                                    </div>
                                    <div data-return-passenger data-passenger-direction="return" class="grid grid-cols-[minmax(4.5rem,1fr)_auto] items-center gap-3 sm:block">
                                        <span class="text-xs font-bold uppercase text-slate-500 sm:sr-only">{{ $t['return'] }}</span>
                                        <div class="flex items-center gap-2">
                                            <button type="button" data-counter-minus class="h-9 w-9 rounded-md border border-slate-300 text-lg font-bold text-slate-600 hover:bg-slate-100" aria-label="{{ $t['remove_return_passenger'] }}">-</button>
                                            <input type="number" name="return_passengers[]" min="0" value="{{ old('return_passengers.' . $loop->index, 0) }}" class="h-9 w-14 rounded-md border border-slate-300 text-center text-sm font-bold text-slate-950">
                                            <button type="button" data-counter-plus class="h-9 w-9 rounded-md bg-primary text-lg font-bold text-white hover:bg-primary-700" aria-label="{{ $t['add_return_passenger'] }}">+</button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-5 ui-panel p-4" data-passenger-details-wrapper hidden>
                            <h3 class="text-base font-bold text-slate-950">{{ $t['passenger_details'] }}</h3>
                            <div class="mt-4 space-y-4" data-passenger-details></div>
                        </div>
                    </section>
                </div>

                <aside class="space-y-6 lg:sticky lg:top-24 lg:self-start">
                    <section class="ui-card p-5">
                        <div class="flex items-start gap-3">
                            <span class="ui-step">4</span>
                            <div>
                                <h2 class="text-xl font-bold text-slate-950">{{ $t['vehicle'] }}</h2>
                                <p class="mt-1 text-sm text-slate-600">{{ $t['vehicle_help'] }}</p>
                            </div>
                        </div>
                        <div class="mt-5 space-y-4">
                            <div>
                                <label for="vehicle_brand" class="ui-label">{{ $t['brand'] }} <span class="text-red-600" aria-hidden="true">*</span></label>
                                <select id="vehicle_brand" name="vehicle_brand" required data-selected-value="{{ old('vehicle_brand') }}" class="ui-input">
                                    <option value="">{{ $t['select'] }}</option>
                                </select>
                            </div>
                            <div data-other-brand hidden>
                                <label for="vehicle_brand_other" class="ui-label">{{ $t['other_brand'] }} <span class="text-red-600" aria-hidden="true">*</span></label>
                                <input id="vehicle_brand_other" name="vehicle_brand_other" type="text" value="{{ old('vehicle_brand_other') }}" class="ui-input">
                            </div>
                            <div>
                                <label for="vehicle_model" class="ui-label">{{ $t['model'] }} <span class="text-red-600" aria-hidden="true">*</span></label>
                                <select id="vehicle_model" name="vehicle_model" required disabled data-selected-value="{{ old('vehicle_model') }}" class="ui-input">
                                    <option value="">{{ $t['select'] }}</option>
                                </select>
                            </div>
                            <div data-other-model hidden>
                                <label for="vehicle_model_other" class="ui-label">{{ $t['other_model'] }} <span class="text-red-600" aria-hidden="true">*</span></label>
                                <input id="vehicle_model_other" name="vehicle_model_other" type="text" value="{{ old('vehicle_model_other') }}" class="ui-input">
                            </div>
                            <div>
                                <label for="vehicle_year" class="ui-label">{{ $t['model_year'] }}</label>
                                <select id="vehicle_year" name="vehicle_year" data-selected-year="{{ old('vehicle_year') }}" disabled class="ui-input">
                                    <option value="">{{ $t['select_year'] }}</option>
                                </select>
                                <label data-vehicle-year-manual-toggle-wrapper class="mt-3 flex items-center gap-2 text-sm font-semibold text-slate-800" hidden>
                                    <input id="vehicle_year_manual_toggle" type="checkbox" data-vehicle-year-manual-toggle class="h-4 w-4 rounded border-slate-300 text-primary">
                                    {{ $t['manual_year'] }}
                                </label>
                                <div data-vehicle-year-manual hidden>
                                    <label for="vehicle_year_manual" class="ui-label mt-3">{{ $t['enter_model_year'] }}</label>
                                    <input id="vehicle_year_manual" name="vehicle_year" type="text" maxlength="4" inputmode="numeric" pattern="\d{4}" placeholder="YYYY" value="{{ old('vehicle_year') }}" disabled class="ui-input">
                                </div>
                            </div>
                            <div class="ui-panel p-5">
                                <label class="flex items-start gap-3 text-sm font-semibold text-slate-900">
                                    <input type="checkbox" name="vehicle_custom_dimensions" value="1" data-vehicle-dimensions-toggle @checked(old('vehicle_custom_dimensions')) class="mt-1 h-4 w-4 rounded border-slate-300 text-primary">
                                    {{ $t['custom_dimensions'] }}
                                </label>
                                <div data-vehicle-dimensions class="mt-4 grid gap-3" hidden>
                                    <div>
                                        <label for="vehicle_length" class="ui-label">{{ $t['length'] }} <span class="text-red-600" aria-hidden="true">*</span></label>
                                        <input id="vehicle_length" name="vehicle_length" type="number" step="0.01" min="0" value="{{ old('vehicle_length', '4.50') }}" disabled class="ui-input">
                                    </div>
                                    <div>
                                        <label for="vehicle_height" class="ui-label">{{ $t['height'] }} <span class="text-red-600" aria-hidden="true">*</span></label>
                                        <input id="vehicle_height" name="vehicle_height" type="number" step="0.01" min="0" value="{{ old('vehicle_height', '1.70') }}" disabled class="ui-input">
                                    </div>
                                    <div>
                                        <label for="vehicle_width" class="ui-label">{{ $t['width'] }} <span class="text-red-600" aria-hidden="true">*</span></label>
                                        <input id="vehicle_width" name="vehicle_width" type="number" step="0.01" min="0" value="{{ old('vehicle_width', '1.80') }}" disabled class="ui-input">
                                    </div>
                                </div>
                            </div>
                            <div class="ui-panel p-5">
                                <label class="flex items-center gap-3 text-sm font-bold text-slate-950">
                                    <input type="checkbox" name="has_roof_box" value="1" data-roof-box-toggle @checked(old('has_roof_box')) class="h-4 w-4 rounded border-slate-300 text-primary">
                                    {{ $t['roof_box'] }}
                                </label>
                                <div data-roof-box-panel class="mt-5 space-y-4" hidden>
                                    <div class="space-y-4">
                                        <div>
                                            <label class="flex items-start gap-2 text-sm font-semibold text-slate-800">
                                                <input type="checkbox" name="has_roof_extra" value="1" data-extra-dimension-toggle data-extra-dimension-target="height" @checked(old('has_roof_extra')) class="mt-1 h-4 w-4 rounded border-slate-300 text-primary">
                                                {{ $t['roof_extra_question'] }}
                                            </label>
                                            <div data-extra-dimension-select-wrapper="height" class="mt-3" hidden>
                                                <label for="roof_extra_height" class="ui-label">{{ $t['extra_height'] }} <span class="text-red-600" aria-hidden="true">*</span></label>
                                                <select id="roof_extra_height" name="roof_extra_height" data-extra-dimension-select data-extra-dimension-target="height" data-selected-value="{{ old('roof_extra_height') }}" disabled class="ui-input">
                                                    @foreach ([['0.50', $t['up_to_05']], ['1.00', $t['up_to_100']]] as [$value, $label])
                                                        <option value="{{ $value }}">{{ $label }}</option>
                                                    @endforeach
                                                </select>
                                                <label class="mt-3 flex items-center gap-2 text-sm font-semibold text-slate-800">
                                                    <input type="checkbox" name="roof_extra_outward" value="1" data-extra-dimension-direction data-extra-dimension-target="height" @checked(old('roof_extra_outward', '1')) disabled class="h-4 w-4 rounded border-slate-300 text-primary">
                                                    {{ $t['outward'] }}
                                                </label>
                                            </div>
                                        </div>
                                        <div>
                                            <label class="flex items-start gap-2 text-sm font-semibold text-slate-800">
                                                <input type="checkbox" name="has_back_extra" value="1" data-extra-dimension-toggle data-extra-dimension-target="length" @checked(old('has_back_extra')) class="mt-1 h-4 w-4 rounded border-slate-300 text-primary">
                                                {{ $t['back_extra_question'] }}
                                            </label>
                                            <div data-extra-dimension-select-wrapper="length" class="mt-3" hidden>
                                                <label for="back_extra_length" class="ui-label">{{ $t['extra_length'] }} <span class="text-red-600" aria-hidden="true">*</span></label>
                                                <select id="back_extra_length" name="back_extra_length" data-extra-dimension-select data-extra-dimension-target="length" data-selected-value="{{ old('back_extra_length') }}" disabled class="ui-input">
                                                    @foreach ([['0.50', $t['up_to_05']], ['1.00', $t['up_to_100']]] as [$value, $label])
                                                        <option value="{{ $value }}">{{ $label }}</option>
                                                    @endforeach
                                                </select>
                                                <label class="mt-3 flex items-center gap-2 text-sm font-semibold text-slate-800">
                                                    <input type="checkbox" name="back_extra_outward" value="1" data-extra-dimension-direction data-extra-dimension-target="length" @checked(old('back_extra_outward', '1')) disabled class="h-4 w-4 rounded border-slate-300 text-primary">
                                                    {{ $t['outward'] }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="ui-panel p-5">
                                <label class="flex items-center gap-3 text-sm font-bold text-slate-950">
                                    <input type="checkbox" name="has_trailer" value="1" data-trailer-toggle @checked(old('has_trailer')) class="h-4 w-4 rounded border-slate-300 text-primary">
                                    {{ $t['trailer_reservation'] }}
                                </label>
                                <div data-trailer-panel class="mt-5 space-y-4" hidden>
                                    <div class="grid gap-3 sm:grid-cols-2">
                                        <label class="flex items-center gap-2 text-sm font-semibold text-slate-800">
                                            <input type="checkbox" name="trailer_outward" value="1" @checked(old('trailer_outward', '1'))>
                                            {{ $t['outward'] }}
                                        </label>
                                        <label data-trailer-return class="flex items-center gap-2 text-sm font-semibold text-slate-800">
                                            <input type="checkbox" name="trailer_return" value="1" @checked(old('trailer_return', '1'))>
                                            {{ $t['return'] }}
                                        </label>
                                    </div>
                                    <div>
                                        <p class="ui-label">{{ $t['trailer_type'] }} <span class="text-red-600" aria-hidden="true">*</span></p>
                                    </div>
                                    <div class="grid gap-2">
                                        @foreach ([['Trailer', $t['trailer']], ['Boat trailer', $t['boat_trailer']], ['Caravan', $t['caravan']]] as [$value, $label])
                                            <label class="flex items-center gap-2 text-sm font-semibold text-slate-800">
                                                <input type="radio" name="trailer_type" value="{{ $value }}" @checked(old('trailer_type') === $value) disabled>
                                                {{ $label }}
                                            </label>
                                        @endforeach
                                    </div>
                                    <div class="grid gap-3 sm:grid-cols-3 lg:grid-cols-1">
                                        <div>
                                            <label for="trailer_length" class="ui-label">{{ $t['trailer_length'] }} <span class="text-red-600" aria-hidden="true">*</span></label>
                                            <input id="trailer_length" name="trailer_length" type="number" step="0.01" min="0" value="{{ old('trailer_length', '2.90') }}" class="ui-input">
                                        </div>
                                        <div>
                                            <label for="trailer_height" class="ui-label">{{ $t['trailer_height'] }} <span class="text-red-600" aria-hidden="true">*</span></label>
                                            <input id="trailer_height" name="trailer_height" type="number" step="0.01" min="0" value="{{ old('trailer_height', '1.41') }}" class="ui-input">
                                        </div>
                                        <div>
                                            <label for="trailer_width" class="ui-label">{{ $t['trailer_width'] }} <span class="text-red-600" aria-hidden="true">*</span></label>
                                            <input id="trailer_width" name="trailer_width" type="number" step="0.01" min="0" value="{{ old('trailer_width', '0.00') }}" class="ui-input">
                                        </div>
                                    </div>
                                    <input name="trailer_license_number" type="text" value="{{ old('trailer_license_number') }}" placeholder="{{ $t['trailer_license'] }}" class="ui-input">
                                    <input name="trailer_owner" type="text" value="{{ old('trailer_owner') }}" placeholder="{{ $t['trailer_owner'] }}" class="ui-input">
                                </div>
                            </div>
                            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-1">
                                <div>
                                    <label for="vehicle_license_number" class="ui-label">{{ $t['license_plate'] }} <span class="text-red-600" aria-hidden="true">*</span></label>
                                    <input id="vehicle_license_number" name="vehicle_license_number" type="text" value="{{ old('vehicle_license_number') }}" required class="ui-input">
                                </div>
                                <div>
                                    <label for="vehicle_owner" class="ui-label">{{ $t['owner'] }} <span class="text-red-600" aria-hidden="true">*</span></label>
                                    <input id="vehicle_owner" name="vehicle_owner" type="text" value="{{ old('vehicle_owner') }}" required class="ui-input">
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="rounded-lg border border-amber-200 bg-amber-50 p-5 text-amber-950">
                        <h2 class="font-bold">{{ $t['height_confirmation'] }}</h2>
                        <p class="mt-2 text-sm leading-6">
                            {{ $t['height_warning'] }}
                        </p>
                        <label class="mt-4 flex items-start gap-3 text-sm font-bold">
                            <input type="checkbox" name="height_acceptance" value="1" required class="mt-1 h-4 w-4 rounded border-amber-300 text-primary">
                            {{ $t['height_acceptance'] }} <span class="text-red-600" aria-hidden="true">*</span>
                        </label>
                    </section>

                    <button type="submit" class="ui-button-primary reservation-submit-loader w-full py-3" data-reservation-submit aria-busy="false">
                        <span class="reservation-submit-spinner" aria-hidden="true"></span>
                        <span data-submit-default class="inline-flex items-center gap-2">
                            <x-icon name="ship" />
                            <span>{{ $t['send'] }}</span>
                        </span>
                        <span data-submit-loading class="hidden">{{ $t['sending'] }}</span>
                    </button>
                </aside>
            </div>
        </form>
        <script type="application/json" id="ctn-validation-errors">@json($errors->messages())</script>
        <script type="application/json" id="ctn-old-input">@json(old())</script>
        <script type="application/json" id="ctn-ui-copy">@json($t['js'])</script>
    </section>
</x-layouts.app>
