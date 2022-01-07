<?php
use App\lib\Router as Route;

Route::get("/", [HomeController::class, "index"])->name("homepage");

Route::get("/user/{id}", [HomeController::class, "find"])->name("third");
Route::get("/user/create", [HomeController::class, "create"])->name("fourth");