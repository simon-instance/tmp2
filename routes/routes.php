<?php
use App\lib\Router as Route;

Route::get("/", [HomeController::class, "index"]);
Route::get("/movieDetails/{index}", [MovieController::class, "show"]);

Route::get("/register", [RegisterController::class, "show"]);
Route::post("/register/create", [RegisterController::class, "create"]);
