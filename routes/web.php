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

use Illuminate\Support\Facades\Route;
Route::get('/','ArticleController@index');

Route::get('/article','ArticleController@index');
Route::get('/article/create','ArticleController@createArticle');
Route::post('/article/save','ArticleController@saveArticle');
Route::post('/article/imageUpload','ArticleController@imageUpload');
Route::get('/article/delete/{id}','ArticleController@deleteArticleById');
Route::get('/article/modify/{id}','ArticleController@modifyArticleForm');
Route::post('/article/modify','ArticleController@modifyArticle');
Route::get('/article/{id}','ArticleController@getArticleById')->where('id', '[0-9]+');
Route::post('/article/{article}/comment','ArticleController@comment');
Route::get('/article/{article}/support','ArticleController@support');
Route::get('/article/{article}/unSupport','ArticleController@unSupport');

Route::prefix('/user')->group(function (){
   Route::get('/login','Auth\AuthController@loginForm');
   Route::post('/login','Auth\AuthController@login');
   Route::get('/logout','Auth\AuthController@logout');
    Route::post('/register','Auth\AuthController@register');

   Route::get('/{user}','UserController@show');
   Route::post('/{user}/fan','UserController@fan');
   Route::post('/{user}/unfan','UserController@unfan');
   Route::get('/{user}','UserController@show');


});
