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
Route::get('/old-video-test', function () {
    return view('videos.old-loader');
});

Route::get('/old', function(){
  return view('analoge-websites.layout');
});

Route::post('/sendmail', function (\Illuminate\Http\Request $request, \Illuminate\Mail\Mailer $mailer) {
    $mailer
        //to who to send the email
        ->to('tomi_emmen@hotmail.com')
        // actually send the email
        ->send(new \App\Mail\ContactMail($request->input('name'), $request->input('email'), $request->input('content')));
    return redirect()->back();

})->name('sendmail');


//routes for our promotion images
Route::get('/hunebedcentrum', function(){
    return view('big-promotion.hunebed');
});

Route::get('/peter-van-dijk', function(){
    return view('big-promotion.peter-van-dijk');
});

Route::get('/whitegoblingames', function(){
    return view('big-promotion.white-goblin-games');
});

Route::get('/gevangenis-museum', function () {
    return view('big-promotion.gevangenis-museum');
});

Route::get('/portfolio', function(){
    return response()->file(public_path('images/promotion/Dhevak/Dhevak-Portfolio.pdf'));
});

// auth
Auth::routes();
