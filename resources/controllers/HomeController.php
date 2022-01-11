<?php

namespace App\resources\controllers;
use App\lib\QueryBuilder as qb;

class HomeController {
    private $filterGenres = false;

    public function index() {
        $qb = new qb();

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
                $personQb = new qb();
                $personQb->query($sql, [$personCastId->person_id]);
                $person = $personQb->get();
                $personCastIds[$key]->firstname = $person[0]->firstname;
                $personCastIds[$key]->lastname = $person[0]->lastname;
            }
            foreach($personDirectorIds??[] as $key=>$personDirectorId) {
                $sql = "SELECT firstname, lastname FROM Person WHERE person_id = ?";
                $personQb = new qb();
                $personQb->query($sql, [$personDirectorId->person_id]);
                $person = $personQb->get();
                $personDirectorIds[$key]->firstname = $person[0]->firstname;
                $personDirectorIds[$key]->lastname = $person[0]->lastname;
            }

            $res[$reskey]->movie_cast_person_ids = $personCastIds;
            $res[$reskey]->movie_director_person_ids = $personDirectorIds;
        }

        return view("index", ["movies" => $res, "genres" => $this->getGenres()]);
    }

    public function applyFilter() {
        $this->filterGenres = true;
        $searchGenres = $this->getGenres(request()->POST);
        $qb = new qb();

        $sql = "SELECT *,
        (SELECT genre_name FROM Movie_Genre MG WHERE MG.movie_id = M.movie_id FOR JSON AUTO) as genre_names,
        (SELECT person_id FROM Movie_Cast MC WHERE MC.movie_id = M.movie_id FOR JSON AUTO) as movie_cast_person_ids,
        (SELECT person_id FROM Movie_Director MD WHERE MD.movie_id = M.movie_id FOR JSON AUTO) as movie_director_person_ids
        FROM Movie M
        WHERE M.title LIKE ?";

        $qb->query($sql, ["%" . request()->POST["search"] . "%"]);
        $res = $qb->get();
        foreach($res as $reskey=>$respart) {
            $personCastIds = json_decode($respart->movie_cast_person_ids);
            $personDirectorIds = json_decode($respart->movie_director_person_ids);
            $genres = json_decode($respart->genre_names);

            $res[$reskey]->genres = [];
            foreach($genres??[] as $genre) {
                $res[$reskey]->genres[] = $genre->genre_name;
            }
            if(!array_diff($searchGenres??[], $res[$reskey]->genres??[]) == false) {
                unset($res[$reskey]);
                continue;
                // continue makes the code faster
            }
            foreach($personCastIds??[] as $key=>$personCastId) {
                $sql = "SELECT firstname, lastname FROM Person WHERE person_id = ?";
                $personQb = new qb();
                $personQb->query($sql, [$personCastId->person_id]);
                $person = $personQb->get();
                $personCastIds[$key]->firstname = $person[0]->firstname;
                $personCastIds[$key]->lastname = $person[0]->lastname;
            }
            foreach($personDirectorIds??[] as $key=>$personDirectorId) {
                $sql = "SELECT firstname, lastname FROM Person WHERE person_id = ?";
                $personQb = new qb();
                $personQb->query($sql, [$personDirectorId->person_id]);
                $person = $personQb->get();
                $personDirectorIds[$key]->firstname = $person[0]->firstname;
                $personDirectorIds[$key]->lastname = $person[0]->lastname;
            }
            
            if(isset($res[$reskey]->movie_cast_person_ids)) {
                $res[$reskey]->movie_cast_person_ids = $personCastIds;
            }
            if(isset($res[$reskey]->movie_director_person_ids)) {
                $res[$reskey]->movie_director_person_ids = $personDirectorIds;
            }
        }

        // $selectedGenres = [];
        // foreach(request()->POST as $key=>$postval) {
        //     if($key !== "search") {
        //         $selectedGenres[] = $postval;
        //     }
        // }
        session()->set("movies", $res);

        return view("index");
    }
    
    public function getGenres(array $genres = []) {
        if($this->filterGenres === true){
            $genrePlaceholders = substr(str_repeat("?, ", count($genres)), 0, -2);
            $sql = "SELECT genre_name FROM Genre WHERE genre_name IN ({$genrePlaceholders})";

            $qb = new qb;
            $qb->query($sql, array_keys($genres));
            $newGenres = [];
            foreach($qb->get() as $genre) {
                $newGenres[] = $genre->genre_name;
            }
            return $newGenres;
        } else {
            $sql = "SELECT genre_name FROM Genre";

            $qb = new qb;
            $qb->query($sql);
            return $qb->get();
        }
    }

    public function privacy() {
        return view("privacy");
    }

    public function about() {
        return view("about");
    }

    public function subscription() {
        return view("subscription");
    }
}