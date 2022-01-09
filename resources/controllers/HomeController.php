<?php

namespace App\resources\controllers;
use App\lib\QueryBuilder;

class HomeController {
    public function index() {
        $qb = new QueryBuilder();

        $sql = "SELECT *,
        (SELECT genre_name FROM Movie_Genre MG WHERE MG.movie_id = M.movie_id FOR JSON AUTO) as genre_name,
        (SELECT person_id FROM Movie_Cast MC WHERE MC.movie_id = M.movie_id FOR JSON AUTO) as movie_cast_person_ids,
        (SELECT person_id FROM Movie_Director MD WHERE MD.movie_id = M.movie_id FOR JSON AUTO) as movie_director_person_ids
        FROM Movie M
        ";

        $qb->query($sql);
        $res = $qb->get();
        foreach($res as $respart) {
            $personCastIds = json_decode($respart->movie_cast_person_ids);
            $personDirectorIds = json_decode($respart->movie_director_person_ids);

            // foreach($personCastIds)
        }
        dd($res);

        return view("index", ["movies" => $res]);
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