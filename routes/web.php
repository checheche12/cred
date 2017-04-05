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

// only Administrator

Route::get('/certificate',function(){
	return view('email.certificate');
});

Route::get('/administrator',function(){
	return view('administrator.administrator');
});

Route::get('/administratorgetuser',function(){
	return view('administrator.getuser');
});

Route::get('/administratorgetpost',function(){
	return view('administrator.getpost');
});

Route::get('/administratordeleteuser',function(){
	return view('administrator.deleteuser');
});

Route::get('/administratordeletepost',function(){
	return view('administrator.deletepost');
});


// 일반 유저들 사용하는 router

Route::get('/',function(){
	return view('firstLogin');
});

Route::get('/header',function(){
	return view('header');
});

Route::get('/ProfileBasicInfo',function(){
	return view('ProfileBasicInfo');
});

Route::get('/ProfileAnotherBasicInfo',function(){
	return view('ProfileAnotherBasicInfo');
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

Route::get('/postUp',function(){
	return view('postUpdate');
});
Route::get('/getContentURL',function(){
	return view('DBSelect.GetContentByDB');
});

Route::get('/token',function(){
	return view('DBSelect.getToken');
});

Route::get('/signup',function(){
	return view('signup');
});

Route::post('/checkSignup',function(){
	return view('checkSignup');
});

Route::get('/getWorkList',function(){
	return view('DBSelect.getWorkList');
});

Route::get('/upload',function(){
	return view('upload.upload');
});

Route::post('/checkAddcredit',function(){
	return view('upload.checkAddcredit');
});

Route::post('/uploadWriteDB',function(){
	return view('upload.uploadWriteDB');
});

Route::post('/uploadFixedDB',function(){
	return view('upload.uploadFixedDB');
});

Route::post('/informationEdit/informationUp',function(){
	return view('information.informationUpdate');
});

Route::post('/informationEdit/informationCareer',function(){
	return view('information.informationCareer');
});

Route::get('/informationEdit',function(){
	return view('information.informationEdit');
});

Route::post('/bridgeLoader',function(){
	return view('bridgeLoader');
});

Route::get('/anotherProfile',function(){
	return view('anotherProfile');
});

Route::get('/getContentAnother',function(){
	return view('DBSelect.GetContentByAnotherDB');
});

Route::get('/getNameSuggest',function(){
	return view('NameSuggest');
});

Route::get('/fixed',function(){
	return view('upload.fixed');
});

Route::get('/delete',function(){
	return view('upload.delete');
});

Route::get('/getuserPK',function(){
	return view('DBSelect.getuserPK');
});

Route::get('/email',function(){
	return view('DBSelect.email');
});

Route::post('/newMember',function(){
	return view('newMember');
});

Route::get('/Yourart',function(){
	return view('yourart');
});

Route::get('/moveart',function(){
	return view('upload.moveart');
});
Route::get('/searchProcess',function(){
	return view('searchProcess');
});
Route::get('/forward',function(){
	return view('msg.forward');
});

Route::post('/msgSendDB',function(){
	return view('msg.msgSendDB');
});
Route::get('/msgRetrieveDB',function(){
	return view('msg.msgRetrieveDB');
});
Route::get('/memberLoader',function(){
	return view('DBSelect.memberLoader');
});

Route::get('/passwordinit',function(){
	return view('email.passwordinit');
});

Route::get('/passwordinitemail',function(){
	return view('email.passwordinitemail');
});

Route::get('/passwordgetinit',function(){
	return view('email.passwordgetinit');
});

Route::post('/passwordchangedone',function(){
	return view('email.passwordchangedone');
});

Auth::routes();
