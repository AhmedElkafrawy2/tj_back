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

Route::prefix('user')->group(function () {
    Route::post("/register" , "Site\AuthController@register");
    Route::post("/login" , "Site\AuthController@login");
    Route::get("/logout" , "Site\AuthController@Logout");
});

Route::prefix('experiment')->group(function () {
    Route::get("/all" ,  "Site\ExperimentController@get_all_experiments");
    Route::get("/{id}" , "Site\ExperimentController@get_certain_experiment");
    Route::prefix('add')->group(function () {
        Route::get("/" ,  "Site\ExperimentController@getAddExperiment");
        Route::post("/" , "Site\ExperimentController@postAddExperiment");
        Route::post("/reply" , "Site\ExperimentController@postAddReply");
    });
});

Route::prefix('question')->group(function () {
    Route::get("/all" ,  "Site\QuestionController@get_all_questions");
    Route::get("/{id}" , "Site\QuestionController@get_certain_question");
    Route::prefix('add')->group(function () {
        Route::get("/" ,  "Site\Site\UserController@getQuestion");
        Route::post("/" , "Site\Site\UserController@postQuestion");
    });
});

Route::prefix('comment')->group(function () {
    Route::post("/add" ,  "Site\CommentController@add_comment");
    Route::post("/reply" ,  "Site\CommentController@add_reply");
});
// Route::middleware(['auth'])->group(function () {
//     Route::get("/add/experiment" , "Site\UserController@getExperiment");
//     Route::post("/add/experiment" , "Site\UserController@postExperiment");
    
//     Route::get("/add/question" , "Site\UserController@getQuestion");
//     Route::post("/add/question" , "Site\UserController@postQuestion"); 
    
// });


