<?php

namespace App\resources\controllers;
use App\resources\models\Movie;

class MovieController {
    public function show() {
        $movies = session()->get("movies");

        if(session()->get("user") == null) {
            return view("login", ["user" => null]);
        }
        return view("movieDetails/detailledPage", ["movie" => $movies[request()->index]]);
    }
}