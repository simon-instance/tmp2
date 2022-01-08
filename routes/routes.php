<?php
use App\lib\Router as Route;

Route::get("/", [HomeController::class, "index"])->name("homepage");

Route::get("/user/{id}", [HomeController::class, "find"]);
Route::get("/user/create", [HomeController::class, "create"]);
Route::get("/movieDetails/{index}", [MovieController::class, "show"]);