<?php

namespace App\resources\controllers;
use App\lib\QueryBuilder;

class HomeController {
    public function index() {
        $qb = new QueryBuilder();

        $sql = "SELECT * FROM Movie M
        LEFT JOIN Movie_Genre MG ON M.movie_id = MG.movie_id
        LEFT JOIN Genre G ON MG.genre_name = G.genre_name
        LEFT JOIN Movie_Director MD ON M.movie_id = MD.movie_id
        LEFT JOIN Movie_Cast MC ON M.movie_id = MC.movie_id
        LEFT JOIN Movie_Genre on 
        LEFT JOIN Person P ON MD.person_id = P.Person_id
        ";
        $qb->query($sql);

        return view("index", ["movies" => $movies]);
    }

    public function secondIndex() {
        die("lol");
    }

    public function find() {
        // dump((new User)->findOne("userId", 2));
    }

    public function create() {
        // $user = (new User)->create();
        // $user->subscriptionId = 1;
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