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

Route::get('/', 'PostsController@index');

//ユーザ登録
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');

//認証
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');

//投稿
Route::group(['middleware' => ['auth']], function() {
    //退会機能
    Route::resource('users','UsersController',['only'=>['show','destroy']]); //destroyを追記
    //確認画面に飛ばす
    Route::get('users','UsersController@delete_confirm')->name('users.delete_confirm');
    
    Route::get('myposts', 'PostsController@myposts')->name('posts.myposts');
    Route::resource('posts', 'PostsController', ['except' => ['show']]);
    //検索ボタンを押すとPostsControllerのsearchメソッドを実行
    Route::get('search', 'PostsController@search')->name('posts.search');
    //新着投稿と検索結果の投稿一覧のGravatarからそのユーザの投稿一覧ページへ移動
    Route::resource('users', 'UsersController', ['only' => 'show']);
    Route::get('videos', 'VideosController@youtube');
});
