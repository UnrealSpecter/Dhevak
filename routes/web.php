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

Route::get('/', function () {
    return view('videos.loader');
});

Route::get('/old', function () {
    return view('videos.old-loader');
});

Route::get('/hunebedcentrum', function(){
    return view('big-promotion.hunebed');
});
