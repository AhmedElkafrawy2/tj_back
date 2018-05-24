<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'Site\HomeController@index')->name("route.index");
Route::post("/request/getcities","Site\HomeController@requestCities");

Route::post("/user/register" , "Site\AuthController@register");
Route::post("/user/login" , "Site\AuthController@login");
Route::get("/user/logout" , "Site\AuthController@Logout");

Route::middleware(['auth'])->group(function () {
    Route::get("/add/experiment" , "Site\UserController@getExperiment");
    Route::post("/add/experiment" , "Site\UserController@postExperiment");
    
    Route::get("/add/question" , "Site\UserController@getQuestion");
    Route::post("/add/question" , "Site\UserController@postQuestion"); 
});


