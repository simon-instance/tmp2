<?php
use App\lib\Router as Route;

Route::get("/", [HomeController::class, "index"])->name("homepage");
Route::get("/second", [HomeController::class, "secondIndex"])->name("second");