<?php

use src\App\Route;

Route::get("/", "MainController@index");
Route::get("/sub", "MainController@sub");
Route::get("/festival", "MainController@festival");
Route::get("/current", "MainController@current");
Route::get("/festivalCS", "MainController@festivalCS");
Route::get("/login", "MainController@login");
Route::get("/update", "MainController@update");
Route::get("/insert", "MainController@insert");
Route::get('/view', "MainController@view");
Route::get("/cal", "MainController@cal");

Route::post("/login_process", "UserController@login");
Route::get("/logout", "UserController@logout");
Route::get("/down", "PageController@down");
Route::post("/update_process", "PageController@update");
Route::post("/insert_process", "PageController@insert");
Route::get("/delete", "PageController@delete");
Route::post("/review_process", "PageController@review");
Route::get("/delete_review", "PageController@delete_review");
Route::get("/getImage", "PageController@getImage");
Route::get("/openAPI/festivalList.php", "PageController@api");
