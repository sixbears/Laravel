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
/* Route::get('/', function () {
  *coucou  = "coucou";
    return view('welcome', [
      'salut' => coucou
    ]);
});

Route::get('/', function () {
  *coucou  = "coucou";
    return view('user');
});
 */

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
  return view('welcome');
});

Route::get('/contact', [ function()
{
  return view('contact');
}]);

Route::get('/presentation', [ function()
{
  return view('presentation');
}]);

Route::get('/autres', [ function()
{
  return view('autres');
}]);

Route::group(['middleware' => ['role:viewer']], function () {
    Route::get('/viewer', 'ViewerController@index') ->name('viewer');
});

Route::group(['middleware' => ['role:worker']], function () {
  Route::get('/worker', 'WorkerController@index') ->name('worker');
});

Route::group(['middleware' => ['role:user']], function () {
  Route::get('/user', 'UserController@index') ->name('user');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
