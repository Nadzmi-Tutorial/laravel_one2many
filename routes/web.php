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

use App\User;
use App\Post;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/insert', function() {
    $admin = User::findOrFail(1);
    $user = User::findOrFail(2);
    $postAdmin1 = new Post(['title' => 'My first post', 'body' => 'This is my first post']);
    $postAdmin2 = new Post(['title' => 'My first post', 'body' => 'This is my first post']);
    $postUser = new Post(['title' => 'My first post', 'body' => 'This is my first post']);
    
    $admin->posts()->save($postAdmin1);
    $admin->posts()->save($postAdmin2);
    $user->posts()->save($postUser);
});

Route::get('/update', function() {
    $user = User::findOrFail(1);

    // $user->posts()->whereId(1)->update(['title' => 'I love laravel', 'body' => 'This is awesome']);
    $user->posts()->where('id', '=', 2)->update(['title' => 'I love laravel 2', 'body' => 'This is awesome 2']);
});
    
Route::get('/read', function() {
    $user = User::findOrFail(1);

    // return $user->posts;

    foreach($user->posts as $post) {
        echo $post->title . '<br />';
    }
});

Route::get('/delete', function() {
    $user = User::findOrFail(1);

    $user->posts()->whereId(1)->delete();
});

Route::get('/delete-user', function() {
    $admin = User::findOrFail(1);

    $admin->delete();
});
