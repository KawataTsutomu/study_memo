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

/*
|--------------------------------------------------------------------------
|
|--------------------------------------------------------------------------
*/
// Auth関係
Auth::routes();
// 記事一覧表示
Route::get('/', 'ArticleController@index')->name('articles.index');
// 記事投稿関係(ログインしないと利用できない)
Route::resource('/articles', 'ArticleController')->except(['index'])->middleware('auth');;
