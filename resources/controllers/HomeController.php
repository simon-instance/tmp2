<?php

namespace App\resources\controllers;
use App\resources\models\Movie;
use App\resources\models\MovieActor;

class HomeController {
    public function index() {
        $movie = (new Movie);

        $movieTable = Movie::$tableName;
        $movieActorTable = MovieActor::$tableName;

        $sql = "SELECT *, (
            SELECT REPLACE(
                (
                    SELECT * FROM {$movieActorTable} MA 
                    WHERE M.movieId = MA.movieId FOR JSON AUTO
                )
            , '{}', '')
        ) as movieActors FROM {$movieTable} M";
        $movie->query($sql);

        $movies = $movie->get();
        foreach($movies as $key=>$movie) {
            $matches;
            preg_match("/^(\d{2}):(\d{2})/", $movie->duration, $matches);

            unset($matches[0]);
            $matches = array_values($matches);
            foreach($matches as $timeKey=>$match) {
                $addon;
                if($timeKey === 0) $addon = "h";
                else if ($timeKey === 1) $addon = "m";
                $matches[$timeKey] = ltrim($match, '0');
                if($matches[$timeKey] !== "") $matches[$timeKey] .= $timeKey === 0 ? "h" : "m";
            }

            $matches = array_filter($matches, "strlen");
            $movies[$key]->durationString = join(" ", $matches);

            $movieActors = json_decode($movie->movieActors);
            $movies[$key]->movieActors = $movieActors;
        }

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