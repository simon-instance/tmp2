<?php

class Database {
    private const DB_LOGIN = "applicatie";
    private const DB_HOST = "iproj_db";
    private const DB_DATABASE = "Movies";

    private static $verbinding = PDO::class;

    public static function init() {
        $wachtwoord = rtrim(file_get_contents("/run/secrets/password_rdbms_app", true));
        if (!$wachtwoord) {
            throw new RuntimeException("Kon een wachtwoordbestand voor SQL Server niet uitlezen.");
        }

        $driver_options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ];

        self::$verbinding = new PDO("sqlsrv:Server=" . self::DB_HOST . ";Database=" . self::DB_DATABASE . ";ConnectionPooling=0;", self::DB_LOGIN, $wachtwoord, $driver_options);
        // Bewaar het wachtwoord niet langer onnodig in het geheugen van PHP.
        unset($wachtwoord);
    }

    public function __get($prop) {
        if($prop === "conn") return self::$verbinding;
    }
}

Database::init();
