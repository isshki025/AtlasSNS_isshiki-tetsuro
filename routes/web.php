<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

// Auth::routes();


//ログアウト中のページ
Route::group(['middleware' => ['guest']], function () {
  Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
  Route::post('/login', 'Auth\LoginController@login');

  Route::get('/register', 'Auth\RegisterController@register');
  Route::post('/register', 'Auth\RegisterController@register');

  Route::get('/added', 'Auth\RegisterController@added');
  Route::post('/added', 'Auth\RegisterController@added');
});

Route::middleware(['loginUserCheck'])->group(function () {
  Route::get('/top', 'PostsController@index');
  Route::post('/top', 'PostsController@store')->name('posts.store');
  Route::patch('/posts/{post}', 'PostsController@update')->name('posts.update');
  Route::delete('/posts/{post}', 'PostsController@destroy')->name('posts.destroy');

  Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

  Route::get('/profile', 'UsersController@edit')->name('profile.edit');
  Route::post('/profile', 'UsersController@update')->name('profile.update');

  Route::get('/profile/{id}', 'UsersController@show');

  Route::get('/search', 'UsersController@search')->name('users.search');

  Route::post('/follow/{user}', 'FollowsController@store')->name('follow');
  Route::delete('/unfollow/{user}', 'FollowsController@destroy')->name('unfollow');
  Route::post('/users/{user}/follow', 'UsersController@follow')->name('users.follow');
  Route::delete('/users/{user}/unfollow', 'UsersController@unfollow')->name('users.unfollow');

  Route::get('/follow-list', 'FollowsController@followList')->name('followList');
  Route::get('/follower-list', 'PostsController@index');
  Route::get('/follower-list', 'FollowsController@followerList')->name('followerList');
});
