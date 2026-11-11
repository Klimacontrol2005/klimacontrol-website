<?php

if(!empty($_POST['website'])){
exit;
}

$to = "info@klimacontrol.be";

$offerte = htmlspecialchars($_POST['offerte']);
$firma = htmlspecialchars($_POST['firma']);
$naam = htmlspecialchars($_POST['naam']);
$email = htmlspecialchars($_POST['email']);
$tel = htmlspecialchars($_POST['tel']);
$adres = htmlspecialchars($_POST['adres']);
$bron = htmlspecialchars($_POST['bron']);

$subject = "Nieuwe koeltechniek offerte aanvraag";

$message = "
Nieuwe offerte aanvraag

Offerte voor: $offerte

Firma: $firma
Naam: $naam
Email: $email
Telefoon: $tel
Adres: $adres

Via gevonden: $bron
";

$headers = "From: website@klimacontrol.be";

mail($to,$subject,$message,$headers);

/* MAIL NAAR KLANT */

$client_subject = "Wij hebben uw aanvraag ontvangen";

$client_message = "
Beste $naam,

Bedankt voor uw aanvraag bij Klimacontrol.

Wij hebben uw aanvraag voor '$offerte' goed ontvangen en nemen zo snel mogelijk contact met u op.

Met vriendelijke groet,

Klimacontrol
www.klimacontrol.be
";

$client_headers = "From: info@klimacontrol.be";

mail($email,$client_subject,$client_message,$client_headers);

echo "ok";

?>