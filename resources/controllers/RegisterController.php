<?php

namespace App\resources\controllers;

use App\lib\QueryBuilder as qb;

class RegisterController {
    public function show() {
        return view("register");
    }

    public function create() {
        $qb = new qb;
        $postValues = request()->POST;
        $insertValues = request()->POST;
        $insertValues["password"] = password_hash($insertValues["password"], PASSWORD_DEFAULT);
        unset($insertValues["confirmPassword"]);
        $insertValues["agreement"] = $insertValues["agreement"] === "on" ? 1 : 0;
        $unixtime = strtotime($insertValues["birthyear"]);
        $insertValues["birthyear"] = date("Y", $unixtime);

        if(count($insertValues) != 9) {
            session()->set("message", [
                "type" => "Error",
                "data" => "Registration failed, some fields were incorrect.",
                "color" => "rgb(255,190,200)"
            ]);
        } else {
            try {
                // -1 = password confirmation
                $placeholders = substr(str_repeat("?, ", count($postValues) - 1), 0, -2);
                $sql = "INSERT INTO [User](firstname, lastname, country, birthyear, bankAccNo, username, password, subscription_id, agreement)
                OUTPUT Inserted.user_id, Inserted.username, Inserted.subscription_id
                VALUES ({$placeholders})";
                $values = array_values($insertValues);
                $values[7] = (int)$values[7];
                $qb->query($sql, $values);

                session()->set("message", [
                    "type" => "Success",
                    "data" => "You have succesfully registered and are now logged in.",
                    "color" => "rgb(190,255,200)"
                ]);
                session()->set("user", $qb->get()[0]??null);
            } catch(\PDOException $e) {
                if($e->getCode() == 23000) {
                    session()->set("message", [
                        "type" => "Error",
                        "data" => "That username already exists.",
                        "color" => "rgb(255,190,200)"
                    ]);
                } else {
                    session()->set("message", [
                        "type" => "Error",
                        "data" => "An unexpected error occured while trying to create your account.",
                        "color" => "rgb(255,190,200)"
                    ]);
                }
            }
        }
        return view("register");
    }
}