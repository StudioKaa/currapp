<?php

Route::group(['middleware' => 'auth'], function() {

	Route::group(['middleware' => 'admin'], function(){

		Route::resource('educations', 'EducationController', ['except' => ['index', 'show']]);
		Route::resource('cohorts', 'CohortController', ['except' => ['index', 'show']]);
		Route::resource('terms', 'TermController', ['except' => ['index', 'show']]);
		Route::resource('lesson_types', 'LessonTypeController', ['except' => ['index', 'show']]);
		Route::resource('lessons', 'LessonController', ['except' => ['index', 'show']]);
		Route::resource('reviews', 'ReviewController', ['except' => ['index', 'show']]);
		Route::get('reviews/addwiki', 'ReviewController@addwiki');
		Route::post('reviews/addwiki', 'ReviewController@savewiki');
		Route::get('reviews/{review}/review', 'ReviewController@review');
		Route::patch('/reviews/{review}/review', 'ReviewController@update_review');
		Route::get('reviews/{review}/wv', 'ReviewController@get_file_wv');
		Route::get('reviews/{review}/tv', 'ReviewController@get_file_tv');
		Route::resource('files', 'FileController', ['except' => ['index', 'show', 'edit', 'update']]);

	});

	Route::redirect('/', '/educations', 301);
	Route::redirect('/home', '/educations', 301);
	Route::get('/educations', 'EducationController@index')->name('home');
	Route::get('/educations/{education}', 'EducationController@show');
	Route::get('/cohorts/{cohort}', 'CohortController@show');
	Route::get('/terms/{term}', 'TermController@show');
	Route::get('/terms/find/{id}', 'TermController@find');
	Route::get('/lessons/{lesson}', 'LessonController@show');
	Route::get('reviews/{review}/sv', 'ReviewController@get_file_sv');
	Route::get('/files/{file}', 'FileController@show');

});

Route::get('/amoclient/ready', function(){
	return redirect('/educations');
});

Route::view('/login', 'login.production')->name('login');

if(env('APP_ENV') == 'local')
{
	Route::view('/login', 'login.local')->name('login');
	Route::post('/login', function(){
		$user = \App\User::find(request('id'));
		\Auth::login($user);
		return redirect('home');
	});
}

Route::view('/login_local', 'login.local')->name('login');
	Route::post('/login', function(){
		$user = \App\User::find(request('id'));
		\Auth::login($user);
		return redirect('home');
	});