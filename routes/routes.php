<?php
use App\lib\Router as Route;

Route::get("/", [HomeController::class, "index"])->name("homepage");
Route::get("/second", [HomeController::class, "secondIndex"])->name("second");

Route::get("/user/{id}", [HomeController::class, "find"])->name("third");
Route::post("/user/{id}/create", [HomeController::class, "create"])->name("fourth");