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





//load frontend
Route::get('/', 'Frontend\ProjectsController@index');

//backend routes
Route::group(['namespace' => 'Backend', 'prefix' => 'admin', 'middleware' => ['auth']], function() {
    Route::resource('', 'DashboardController', ['only' => ['index']]);
    Route::resource('roles', 'RolesController');
    Route::resource('social-media', 'SocialMediaController');
    Route::resource('images', 'ImagesController');
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

// routes for store function Roles

Route::get('/rolesvalidator','Backend\RolesController@store');
Route::post('/rolesvalidator','Backend\RolesController@store');


// routes for store function Social media


Route::get('/socialmediavalidator','Backend\SocialMediaController@store');
Route::post('/socialmediavalidator','Backend\SocialMediaController@store');

// routes fo store function ProjectsController

Route::get('/projectsvalidator','Backend\ProjectsController@store');
Route::post('/projectsvalidator','Backend\ProjectsController@store');

// auth
Auth::routes();
