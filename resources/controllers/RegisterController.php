<?php

namespace App\resources\controllers;

class RegisterController {
    public function show() {
        return view("register");
    }

    public function create() {
        $req = request()->POST;
        // $user = (new User)->create();
        // $user->subscriptionId = ;
        // $user->name = "Timo";
        // $user->surname = "Van Elst";
        // $user->country = "Germany";
        // $user->birthyear = 1950;
        // $user->bankAccNo = "NL11INGB3534343510";
        // $user->username = "Yeet";
        // $user->password = "bamischijf";
        // $user->createdAt = 2022-01-01;
        // $user->save();
    }
}