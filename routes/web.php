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

Route::get('/updateGroupMember',function(){
	return view('updateGroupMember');
});

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

Route::post('/administratoruploadindex',function(){
	return view('administrator.uploadindex');
});

Route::get('/getspotlight',function(){
	return view('administrator.getspotlight');
});

Route::post('/uploadSpotlight',function(){
	return view('administrator.uploadSpotlight');
});

Route::get('/getrecent',function(){
	return view('administrator.getrecent');
});

Route::post('/uploadrecent',function(){
	return view('administrator.uploadRecent');
});





// 일반 유저들 사용하는 router

Route::get('/',function(){
	return view('intro.intro');
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


// 로그인이 되어있지 않다면

Route::group(['middleware' => ['Login']] ,function(){

	Route::get('/login',function(){
			return view('firstLogin');
	});

	Route::post('/auth', function(){
		return view('auth.checkIDPWCorrect');
	});

	Route::get('/signup',function(){
		return view('signup');
	});

	Route::post('/checkSignup',function(){
		return view('checkSignup');
	});

	Route::post('/newMember',function(){
		return view('newMember');
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

});

//로그인이 되어있다면

Route::group(['middleware' => ['isLogin']] ,function(){

		Route::get('/main',function(){
			return view('main');
		});

		Route::get('/Logout',function(){
			return view('auth.Logout');
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

		Route::get('/getContentURL',function(){
			return view('DBSelect.GetContentByDB');
		});

		Route::get('/upload',function(){
			return view('upload.upload');
		});

		Route::post('/msgSendDB',function(){
			return view('msg.msgSendDB');
		});
		Route::get('/msgRetrieveDB',function(){
			return view('msg.msgRetrieveDB');
		});

		Route::get('/forward',function(){
			return view('msg.forward');
		});

		Route::get('/Yourart',function(){
			return view('yourart');
		});

		Route::post('/uploadReply',function(){
			return view('posting.uploadReply');
		});

});

// 권한관계. 내가 크레딧이 걸려있다면... fix와 삭제 하는 경우에는 내 크레딧이 걸려있어야 fixed 가 켜질 수 있다.

Route::group(['middleware' => ['isgetauth']] ,function(){

	Route::get('/fixed',function(){
		return view('upload.fixed');
	});

	Route::get('/delete',function(){
		return view('upload.delete');
	});

});

Route::group(['middleware' => ['isgetauthpost']],function(){

	Route::post('/uploadFixedDB',function(){
		return view('upload.uploadFixedDB');
	});

	Route::post('uploadReplyReply',function(){
		return view('posting.uploadReplyReply');
	});

});




Route::get('/post',function(){
	return view('posting.post');
});

Route::get('/postUp',function(){
	return view('postUpdate');
});

Route::get('/token',function(){
	return view('DBSelect.getToken');
});

Route::get('/getWorkList',function(){
	return view('DBSelect.getWorkList');
});

Route::post('/checkAddcredit',function(){
	return view('upload.checkAddcredit');
});

Route::post('/uploadWriteDB',function(){
	return view('upload.uploadWriteDB');
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

Route::get('/getuserPK',function(){
	return view('DBSelect.getuserPK');
});

Route::get('/email',function(){
	return view('DBSelect.email');
});

Route::get('/moveart',function(){
	return view('upload.moveart');
});
Route::get('/searchProcess',function(){
	return view('searchProcess');
});

Route::get('/memberLoader',function(){
	return view('DBSelect.memberLoader');
});

Route::post('/deleteReply',function(){
	return view('posting.deleteReply');
});
