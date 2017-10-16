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

//start default
Route::get('/', function () {
    return view('partials.video-base');
});


Route::group(['namespace' => 'Backend', 'prefix' => 'admin', 'middleware' => ['auth']], function() {
    Route::resource('', 'DashboardController', ['only' => ['index']]);
    Route::resource('roles', 'RolesController');
    Route::resource('projects', 'ProjectsController');
});

// the old test of the video's
Route::get('/old', function () {
    return view('videos.old-loader');
});

//routes for our promotion images
Route::get('/hunebedcentrum', function(){
    return view('big-promotion.hunebed');
});

Route::get('/petervandijk', function(){
    return view('big-promotion.peter-van-dijk');
});

Route::get('/whitegoblingames', function(){
    return view('big-promotion.white-goblin-games');
});

// auth
Auth::routes();
