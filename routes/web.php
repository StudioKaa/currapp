<?php

Route::group(['middleware' => 'auth'], function() {

	Route::group(['middleware' => 'admin'], function(){

		Route::resource('educations', 'EducationController', ['except' => ['index', 'show']]);
		Route::resource('cohorts', 'CohortController', ['except' => ['index', 'show', 'edit', 'update']]);
		Route::resource('terms', 'TermController', ['except' => ['index', 'show']]);
		Route::resource('lesson_types', 'LessonTypeController', ['except' => ['index', 'show']]);
		Route::resource('lessons', 'LessonController', ['except' => ['index', 'show']]);
		
		Route::resource('lessons.assets', 'AssetController', ['only' => ['delete', 'destroy']]);
		Route::get('lessons/{lesson}/assets/create/file', 'AssetController@create_file')->name('lessons.assets.create.file');
		Route::post('lessons/{lesson}/assets/create/file', 'AssetController@store_file')->name('lessons.assets.store.file');;
		Route::get('lessons/{lesson}/assets/create/link', 'AssetController@create_link')->name('lessons.assets.create.link');;
		Route::post('lessons/{lesson}/assets/create/link', 'AssetController@store_link')->name('lessons.assets.store.link');;
		
		Route::get('lessons/{lesson}/revisions/create/file', 'RevisionCreateController@create_file')->name('revisions.create.file');
		Route::post('lessons/{lesson}/revisions/create/file', 'RevisionCreateController@store_file')->name('revisions.store.file');
		Route::get('lessons/{lesson}/revisions/create/wiki', 'RevisionCreateController@create_wiki')->name('revisions.create.wiki');
		Route::post('lessons/{lesson}/revisions/create/wiki', 'RevisionCreateController@store_wiki')->name('revisions.store.wiki');

		Route::get('revisions/{revision}/addfiles', 'RevisionController@addfiles_form')->name('revisions.edit.files');
		Route::patch('revisions/{revision}/addfiles', 'RevisionController@addfiles_store')->name('revisions.update.files');
		Route::get('revisions/{revision}/wv', 'RevisionController@get_file_wv')->name('revisions.get.wv');
		Route::get('revisions/{revision}/tv', 'RevisionController@get_file_tv')->name('revisions.get.tv');
	});

	Route::redirect('/', '/educations', 301);
	Route::redirect('/home', '/educations', 301);
	Route::get('/educations', 'EducationController@index')->name('home');
	Route::get('/educations/{slug}/now', 'EducationController@now')->name('educations.now');
	Route::get('/educations/{education}', 'EducationController@show')->name('educations.show');
	Route::get('/cohorts/{cohort}', 'CohortController@show')->name('cohorts.show');
	Route::get('/terms/{term}', 'TermController@show')->name('terms.show');
	Route::get('/terms/find/{id}', 'TermController@find');
	Route::get('/lessons/{lesson}', 'LessonController@show')->name('lessons.show');
	Route::get('revisions/{revision}/sv', 'RevisionController@get_file_sv')->name('revisions.get.sv');
});

if(env('APP_ENV') == 'production')
{
	Route::get('/amoclient/ready', function(){
		return redirect()->route('home');
	});
	Route::get('/login', function(){
		return redirect('/amoclient/redirect');
	})->name('login');
}
else
{
	Route::view('/login', 'login.local')->name('login');
	Route::post('/login', function(){
		$user = \App\User::find(request('id'));
		\Auth::login($user);
		return redirect('home');
	});
}
