<?php

Route::group(['middleware' => 'auth'], function() {

	Route::redirect('/', '/educations', 301);
	Route::redirect('/home', '/educations', 301);
	Route::resource('educations', 'EducationController')->name('index', 'home');
	Route::resource('cohorts', 'CohortController', ['except' => ['index']]);
	Route::resource('terms', 'TermController', ['except' => ['index']]);
	Route::get('/terms/find/{id}', 'TermController@find');
	Route::resource('lesson_types', 'LessonTypeController', ['except' => ['index', 'show']]);
	Route::resource('lessons', 'LessonController', ['except' => ['index']]);

	Route::resource('reviews', 'ReviewController', ['except' => ['index', 'show']]);
	Route::get('reviews/addwiki', 'ReviewController@addwiki');
	Route::post('reviews/addwiki', 'ReviewController@savewiki');
	Route::get('reviews/{review}/review', 'ReviewController@review');
	Route::get('reviews/{review}/wv', 'ReviewController@get_file_wv');
	Route::get('reviews/{review}/tv', 'ReviewController@get_file_tv');
	Route::get('reviews/{review}/sv', 'ReviewController@get_file_sv');
	Route::patch('/reviews/{review}/review', 'ReviewController@update_review');

	Route::resource('files', 'FileController', ['except' => ['index', 'edit', 'update']]);

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