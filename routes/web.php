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
Route::resource('/articles', 'ArticleController')->except(['index', 'show'])->middleware('auth');
// 記事詳細画面
Route::resource('/articles', 'ArticleController')->only(['show']);
// いいね機能
Route::prefix('articles')->name('articles.')->group(function () {
    Route::put('/{article}/like', 'ArticleController@like')->name('like')->middleware('auth');
    Route::delete('/{article}/like', 'ArticleController@unlike')->name('unlike')->middleware('auth');
});
// タグ別記事一覧
Route::get('/tags/{name}', 'TagController@show')->name('tags.show');
// ユーザーページ表示
Route::prefix('users')->name('users.')->group(function () {
    Route::get('/{name}', 'UserController@show')->name('show');
    Route::get('/{name}/likes', 'UserController@likes')->name('likes');
// フォロー機能
    Route::middleware('auth')->group(function () {
        Route::put('/{name}/follow', 'UserController@follow')->name('follow');
        Route::delete('/{name}/follow', 'UserController@unfollow')->name('unfollow');
    });
});
