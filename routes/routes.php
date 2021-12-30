<?php
use App\lib\Router as Route;

Route::get("/", [HomeController::class, "index"])->name("homepage");
Route::get("/second", [HomeController::class, "secondIndex"])->name("second");
Route::get("/user/{id}/{lol}", [HomeController::class, "idtest"])->name("third");