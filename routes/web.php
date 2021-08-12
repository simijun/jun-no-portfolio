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
//ゲストログイン
Route::get('lopgin/guest', 'Auth\LoginController@guestLogin')->name('login.guest');


Route::group(['middleware' => ['auth']], function() {
    //フォロー機能
    Route::group(['prefix' => 'users/{id}'], function () {
        Route::post('follow', 'UserFollowController@store')->name('user.follow');
        Route::delete('unfollow', 'UserFollowController@destroy')->name('user.unfollow');
        Route::get('followings', 'UsersController@followings')->name('users.followings');
        Route::get('followers', 'UsersController@followers')->name('users.followers');
    });
    //ユーザ名からユーザ詳細ページへの遷移&退会機能
    Route::resource('users','UsersController',['only'=>['show','destroy']]); //destroyを追記
    //確認画面に飛ばす
    Route::get('users','UsersController@delete_confirm')->name('users.delete_confirm');
    
    Route::get('myposts', 'PostsController@myposts')->name('posts.myposts');
    Route::resource('posts', 'PostsController', ['except' => ['show']]);
    //検索ボタンを押すとPostsControllerのsearchメソッドを実行
    Route::get('search', 'PostsController@search')->name('posts.search');
});
