<?php

declare(strict_types=1);

namespace App\lib;

define('DB_HOST', '172.30.0.2:1433');
define('DB_DATABASE', 'flatnix');

class Database {
    private $verbinding = PDO::class;

    public function __construct() {
        $wachtwoord= rtrim(file_get_contents('/run/secrets/password_rdbms_app', true));
        if (!$wachtwoord) {
            throw new RuntimeException('Kon een wachtwoordbestand voor SQL Server niet uitlezen. ');
        }

        $this->verbinding = new PDO('sqlsrv:Server=' . DB_HOST . ';Database=' . DB_DATABASE . ';ConnectionPooling=0;', DB_LOGIN, $wachtwoord);
        // Bewaar het wachtwoord niet langer onnodig in het geheugen van PHP.
        unset($wachtwoord);
        // Zorg ervoor dat eventuele fouttoestanden ook echt als fouten (exceptions) gesignaleerd worden door PHP.
        $this->verbinding->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Functie om in andere files toegang te krijgen tot de verbinding.
    }
}