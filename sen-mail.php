<?php

$data = json_decode(file_get_contents("php://input"), true);

$to = "info@klimacontrol.be";
$subject = "Nieuwe Airco Offerte Aanvraag";

$message = "
Nieuwe aanvraag via configurator:

Naam: {$data['naam']}
Adres: {$data['adres']}
Email: {$data['email']}

Type: {$data['type']}
Aantal ruimtes: {$data['aantalRuimtes']}
Gebruik: {$data['gebruik']}
Isolatie: {$data['isolatie']}
Merk: {$data['merk']}

Prijsindicatie: €{$data['minPrijs']} - €{$data['maxPrijs']}
";

$headers = "From: website@klimacontrol.be";

mail($to, $subject, $message, $headers);

echo json_encode(["success" => true]);
?>