<?php
use App\lib\Router as Route;

Route::get("/", [HomeController::class, "index"]);
Route::post("/filter", [HomeController::class, "applyFilter"]);

Route::get("/privacy", [HomeController::class, "privacy"]);
Route::get("/about", [HomeController::class, "about"]);

Route::get("/subscription", [HomeController::class, "subscription"]);

Route::get("/movieDetails/{index}", [MovieController::class, "show"]);

Route::get("/register", [RegisterController::class, "show"]);
Route::post("/register/create", [RegisterController::class, "create"]);

Route::get("/login", [LoginController::class, "show"]);
Route::post("/login/startsession", [LoginController::class, "create"]);
