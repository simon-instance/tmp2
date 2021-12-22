<?php
die("yikes");
require_once 'db.php';
$wachtwoord= rtrim(file_get_contents('/run/secrets/password_rdbms_app', true));
if (!$wachtwoord) {
  throw new RuntimeException('Kon een wachtwoordbestand voor SQL Server niet uitlezen. ');
}
// Connectie met de database.
// Onderstaande constanten worden gedefinieerd in:
// https://github.com/hanaim-webtech/WT_IS_Bp/blob/master/webserver/applicatie/config/db.php
$verbinding = new PDO('sqlsrv:Server=' . DB_HOST . ';Database=' . DB_DATABASE . ';ConnectionPooling=0;', DB_LOGIN, $wachtwoord);
// Bewaar het wachtwoord niet langer onnodig in het geheugen van PHP.
unset($wachtwoord);
// Zorg ervoor dat eventuele fouttoestanden ook echt als fouten (exceptions) gesignaleerd worden door PHP.
$verbinding->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Functie om in andere files toegang te krijgen tot de verbinding.
function verkrijgVerbinding() {
  global $verbinding;
  return verbinding;
} 
