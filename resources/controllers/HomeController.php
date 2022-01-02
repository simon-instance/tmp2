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

    public function find() {
        dump((new User)->findOne("userId", 2));
    }

    public function create() {
        $user = (new User)->create();
        $user->subscriptionId = request()->id;
        $user->name = "Timo";
        $user->surname = "Van Elst";
        $user->country = "Germany";
        $user->birthyear = 1950;
        $user->bankAccNo = "NL11INGB3534343510";
        $user->username = "Yeet";
        $user->password = "bamischijf";
        $user->createdAt = 2022-01-01;
        $user->save();
        dump("create");
    }
}