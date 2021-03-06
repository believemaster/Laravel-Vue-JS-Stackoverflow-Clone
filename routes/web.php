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

// Route::get('/', 'function () {
//     return view('welcome');
// }');

use Illuminate\Http\Request;


Route::get('/', 'QuestionsController@index');
Route::get('/home', 'QuestionsController@index')->name('home');

Route::get('/about', 'HomeController@about')->name('about');
Route::get('/how-it-works', 'HomeController@howto')->name('how');
Route::get('/blogs', 'HomeController@index')->name('blogs');

// OAuths
Route::get('/sign-in/google', 'Auth\LoginController@googleLogin')->name('googleLogin');;
Route::get('/sign-in/google/redirect', 'Auth\LoginController@googleLoginRedirect');

Route::get('/sign-in/facebook', 'Auth\LoginController@facebookLogin')->name('fbLogin');;
Route::get('/sign-in/facebook/redirect', 'Auth\LoginController@facebookLoginRedirect');


// Trying BM News Passport OAuth
// Route::get('/redirect', 'HomeController@getToken')->name('get.token');

// Route::get('/callback', 'HomeController@callback');


Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');


Route::resource('questions', 'QuestionsController')->except('show');
// Route::post('/questions/{question}/answers', 'AnswersController@store')->name('answers.store');
Route::resource('questions.answers', 'AnswersController')->except(['create', 'show']);
Route::get('/questions/{slug}', 'QuestionsController@show')->name('questions.show');
Route::post('/answers/{answer}/accept', 'AcceptAnswerController')->name('answers.accept');

Route::post('/questions/{question}/favorites', 'FavoritesController@store')->name('questions.favorite');
Route::delete('/questions/{question}/favorites', 'FavoritesController@destroy')->name('questions.unfavorite');

Route::post('/questions/{question}/vote', 'VoteQuestionController');
Route::post('/answers/{answer}/vote', 'VoteAnswerController');

// Routes Specific for Admin (on Progress)
// Route::get('questions-list', 'AdminController@index');
// Route::delete('questions-list/{id}', 'AdminController@destroy')->name('question-delete');
// Route::get('questions-list', 'AdminController@index');
