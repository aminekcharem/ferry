<!DOCTYPE html>
<html lang="{{ $participation->locale }}">
<head><meta charset="utf-8"><title>Yesmin Tours</title></head>
<body>
    <h1>Yesmin Tours</h1>
    <p>{{ $participation->first_name }} {{ $participation->last_name }},</p>
    @if ($participation->locale === 'fr')
        <p>Félicitations ! Vous avez gagné <strong>{{ $participation->result }} % de réduction</strong> à notre roue de la chance.</p>
        <p>Votre gain a été enregistré. Contactez notre équipe avec l’email utilisé pour participer afin de bénéficier de votre réduction.</p>
    @elseif ($participation->locale === 'de')
        <p>Herzlichen Glückwunsch! Sie haben bei unserem Glücksrad <strong>{{ $participation->result }} % Rabatt</strong> gewonnen.</p>
        <p>Ihr Gewinn wurde gespeichert. Kontaktieren Sie unser Team mit der E-Mail-Adresse Ihrer Teilnahme, um Ihren Rabatt zu nutzen.</p>
    @else
        <p>Congratulations! You won a <strong>{{ $participation->result }}% discount</strong> on our lucky wheel.</p>
        <p>Your prize has been recorded. Contact our team using the email address you entered to claim your discount.</p>
    @endif
</body>
</html>
