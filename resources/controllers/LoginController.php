<?php

namespace App\resources\controllers;

use App\lib\QueryBuilder as qb;

class LoginController {
    public function show() {
        return view("login");
    }

    public function create() {
        $qb = new qb;
        $postValues = request()->POST;


        if(count($postValues) != 2) {
            session()->set("message", [
                "type" => "Error",
                "data" => "Login failed, some fields were incorrect.",
                "color" => "rgb(255,190,200)"
            ]);
        } else {
            $placeholders = substr(str_repeat("?, ", count($postValues)), 0, -2);
            $sql = "SELECT user_id, username, password FROM [User] WHERE username = ?";
            $qb->query($sql, [$postValues["username"]]);
            $userResults = $qb->get();
            $user = $userResults[0];
            if(count($userResults) != 1 || !password_verify($postValues["password"], $user->password)) {
                session()->set("message", [
                    "type" => "Error",
                    "data" => "Login failed, some fields were incorrect.",
                    "color" => "rgb(255,190,200)"
                ]);
            } else {
                session()->set("message", [
                    "type" => "Success",
                    "data" => "You have succesfully logged in.",
                    "color" => "rgb(190,255,200)"
                ]);
                session()->set("user", $user);
            }
        }
        return view("login");
    }
}