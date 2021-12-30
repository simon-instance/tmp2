<?php
namespace App\lib\traits;

trait Singleton {
    private static $instance;

    public final static function getInstance(): self {
        if(!self::$instance) self::$instance = new self();
        return self::$instance;
    }

    public function __clone() {
        throw new Exception("Can't clone a singleton");
    }
}