<?php

namespace App\resources\controllers;
use App\lib\QueryBuilder;

class HomeController {
    public function index() {
        $qb = new QueryBuilder();

        $sql = "SELECT *,
        (SELECT genre_name FROM Movie_Genre MG WHERE MG.movie_id = M.movie_id FOR JSON AUTO) as genre_names,
        (SELECT person_id FROM Movie_Cast MC WHERE MC.movie_id = M.movie_id FOR JSON AUTO) as movie_cast_person_ids,
        (SELECT person_id FROM Movie_Director MD WHERE MD.movie_id = M.movie_id FOR JSON AUTO) as movie_director_person_ids
        FROM Movie M
        ";

        $qb->query($sql);
        $res = $qb->get();
        foreach($res as $reskey=>$respart) {
            $personCastIds = json_decode($respart->movie_cast_person_ids);
            $personDirectorIds = json_decode($respart->movie_director_person_ids);
            $genres = json_decode($respart->genre_names);

            $res[$reskey]->genres = [];
            foreach($genres??[] as $genre) {
                $res[$reskey]->genres[] = $genre->genre_name;
            }
            foreach($personCastIds??[] as $key=>$personCastId) {
                $sql = "SELECT firstname, lastname FROM Person WHERE person_id = ?";
                $personQb = new QueryBuilder();
                $personQb->query($sql, [$personCastId->person_id]);
                $person = $personQb->get();
                $personCastIds[$key]->firstname = $person[0]->firstname;
                $personCastIds[$key]->lastname = $person[0]->lastname;
            }
            foreach($personDirectorIds??[] as $key=>$personDirectorId) {
                $sql = "SELECT firstname, lastname FROM Person WHERE person_id = ?";
                $personQb = new QueryBuilder();
                $personQb->query($sql, [$personDirectorId->person_id]);
                $person = $personQb->get();
                $personDirectorIds[$key]->firstname = $person[0]->firstname;
                $personDirectorIds[$key]->lastname = $person[0]->lastname;
            }

            $res[$reskey]->movie_cast_person_ids = $personCastIds;
            $res[$reskey]->movie_director_person_ids = $personDirectorIds;
        }

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