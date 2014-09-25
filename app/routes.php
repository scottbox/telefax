<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/301', 'HomeController@sportsHeadlines');
Route::get('/302', 'HomeController@footballHeadlines');
Route::get('/303', 'HomeController@footballStory');