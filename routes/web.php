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

Route::get("/contact-us","Site\UserController@get_contact_us");
Route::post("/contact-us","Site\UserController@post_contact_us");

Route::prefix('user')->group(function () {
    Route::post("/register" , "Site\AuthController@register");
    Route::post("/login" , "Site\AuthController@login");
    Route::get("/logout" , "Site\AuthController@Logout");
});

Route::prefix('experiment')->group(function () {
    Route::get("/all" ,  "Site\ExperimentController@get_all_experiments");
    Route::get("/{id}" , "Site\ExperimentController@get_certain_experiment");
    Route::get("/add" ,  "Site\ExperimentController@getExperiment");
    Route::post("/add" , "Site\ExperimentController@postExperiment");
    Route::post("/add/reply" , "Site\ExperimentController@postAddReply");

});

Route::prefix('question')->group(function () {
    Route::get("/all" ,  "Site\QuestionController@get_all_questions");
    Route::get("/{id}" , "Site\QuestionController@get_certain_question");
    Route::get("/add" ,  "Site\Site\QuestionController@getQuestion");
    Route::post("/add" , "Site\Site\QuestionController@postQuestion");
});

Route::prefix('comment')->group(function () {
    Route::post("/add" ,  "Site\CommentController@add_comment");
    Route::post("/reply" ,  "Site\CommentController@add_reply");
});

Route::prefix('pages')->group(function () {
    Route::get("/{name}" ,  "Site\UserController@get_page");
});

Route::prefix('categories')->group(function () {
    Route::get("/{name}" ,  "Site\UserController@get_category");
    Route::get("/experiment/{name}" , "Site\UserController@get_all_categories_exp");
    Route::get("/questions/{name}" , "Site\UserController@get_all_categories_questions");
});
// Route::middleware(['auth'])->group(function () {
//     Route::get("/add/experiment" , "Site\UserController@getExperiment");
//     Route::post("/add/experiment" , "Site\UserController@postExperiment");
    
//     Route::get("/add/question" , "Site\UserController@getQuestion");
//     Route::post("/add/question" , "Site\UserController@postQuestion"); 
    
// });


