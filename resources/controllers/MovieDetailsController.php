<?php

namespace App\resources\controllers;

class HomeController {
    public function show() {
        return view("movieDetails/detailledPage.php", ["id" => request()->id]);
    }
}