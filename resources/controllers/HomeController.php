<?php

namespace App\resources\controllers;
use App\resources\models\User;

class HomeController {
    public function index() {
        die("test");
    }

    public function secondIndex() {
        die("lol");
    }

    public function idtest() {
        dd((new User)->all());
    }
}