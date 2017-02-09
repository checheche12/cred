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

Route::get('/',function(){
	return view('firstLogin');
});


Route::get('UserInfo',function(){
	return view('DBSelect.DB');
});


Route::post('/auth', function(){
	return view('auth.checkIDPWCorrect');
});

Route::get('/main',function(){
	return view('main');
});

Route::get('/Logout',function(){
	return view('auth.Logout');
});

Route::get('/post',function(){
	return view('post');
});


Route::get('/getContentURL',function(){
	return view('DBSelect.GetcontentByDB');
});


Auth::routes();

Route::get('/home', 'HomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index');
