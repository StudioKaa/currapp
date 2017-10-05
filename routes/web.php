<?php

Route::redirect('/', '/educations', 301);
Route::redirect('/home', '/educations', 301);

Route::get('/educations', 'EducationController@index')->name('home');
Route::get('/educations/create', 'EducationController@create');
Route::get('/educations/{education}', 'EducationController@show');
Route::get('/educations/{education}/edit', 'EducationController@edit');
Route::get('/educations/{education}/delete', 'EducationController@delete');
Route::post('/educations', 'EducationController@store');
Route::patch('/educations/{education}', 'EducationController@update');
Route::delete('/educations/{education}', 'EducationController@destroy');

Route::get('/cohorts/create', 'CohortController@create');
Route::get('/cohorts/{cohort}', 'CohortController@show');
Route::get('/cohorts/{cohort}/edit', 'CohortController@edit');
Route::get('/cohorts/{cohort}/delete', 'CohortController@delete');
Route::post('/cohorts', 'CohortController@store');
Route::patch('/cohorts/{cohort}', 'CohortController@update');
Route::delete('/cohorts/{cohort}', 'CohortController@destroy');

Route::get('/terms/find/{id}', 'TermController@find');
Route::get('/terms/create', 'TermController@create');
Route::get('/terms/{term}', 'TermController@show');
Route::get('/terms/{term}/edit', 'TermController@edit');
Route::get('/terms/{term}/delete', 'TermController@delete');
Route::post('/terms', 'TermController@store');
Route::patch('/terms/{term}', 'TermController@update');
Route::delete('/terms/{term}', 'TermController@destroy');

Route::get('/lesson_types/create', 'LessonTypeController@create');
Route::get('/lesson_types/{lesson_type}/edit', 'LessonTypeController@edit');
Route::get('/lesson_types/{lesson_type}/delete', 'LessonTypeController@delete');
Route::post('/lesson_types', 'LessonTypeController@store');
Route::patch('/lesson_types/{lesson_type}', 'LessonTypeController@update');
Route::delete('/lesson_types/{lesson_type}', 'LessonTypeController@destroy');

Route::get('/lessons/create', 'LessonController@create');
Route::get('lessons/{lesson}', 'LessonController@show');
Route::get('lessons/{lesson}/edit', 'LessonController@edit');
Route::get('lessons/{lesson}/delete', 'LessonController@delete');
Route::post('/lessons', 'LessonController@store');
Route::patch('/lessons/{lesson}', 'LessonController@update');
Route::delete('/lessons/{lesson}', 'LessonController@destroy');

Route::get('/reviews/create', 'ReviewController@create');
Route::get('reviews/{review}/edit', 'ReviewController@edit');
Route::get('reviews/{review}/review', 'ReviewController@review');
Route::get('reviews/{review}/delete', 'ReviewController@delete');
Route::post('/reviews', 'ReviewController@store');
Route::patch('/reviews/{review}/review', 'ReviewController@update_review');
Route::patch('/reviews/{review}', 'ReviewController@update');
Route::delete('/reviews/{review}', 'ReviewController@destroy');

Auth::routes();
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');