<?php

declare(strict_types=1);

namespace App\lib;
// We want to use Singleton for safety reasons (e.g we don't want more than 1 open database connection)
use App\lib\traits\Singleton;
use \PDO;

define('DB_LOGIN', 'applicatie');
define('DB_HOST', 'beroepsproduct_db');
define('DB_DATABASE', 'Movies');

class Database {
    use Singleton;

    private static $verbinding = PDO::class;

    public static function init() {
        $wachtwoord = rtrim(file_get_contents('/run/secrets/password_rdbms_app', true));
        if (!$wachtwoord) {
            throw new RuntimeException('Kon een wachtwoordbestand voor SQL Server niet uitlezen. ');
        }

        $driver_options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
        ];

        self::$verbinding = new PDO('sqlsrv:Server=' . DB_HOST . ';Database=' . DB_DATABASE . ';ConnectionPooling=0;', DB_LOGIN, $wachtwoord, $driver_options);
        // Bewaar het wachtwoord niet langer onnodig in het geheugen van PHP.
        unset($wachtwoord);
    }

    public function __get($prop) {
        if($prop === "conn") return self::$verbinding;
    }
}