<?php

namespace App\resources\controllers;
use App\resources\models\Movie;

class MovieController {
    public function show() {
        $movies = session()->get("movies");
        return view("movieDetails/detailledPage", ["movie" => $movies[request()->index]]);
    }
}