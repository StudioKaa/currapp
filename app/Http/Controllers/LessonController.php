<?php

namespace App\Http\Controllers;

use App\Lesson_type;
use App\Lesson;
use Illuminate\Http\Request;
use App\User;
use App\Review;
use App\Review_status;
use App\Traits\GenerateBreadcrumbs;
use Illuminate\Support\Facades\Storage;
use Auth;

class LessonController extends Controller
{
    
    use GenerateBreadcrumbs;

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lesson_type = Lesson_type::find($_GET['lesson_type']);
        $lesson = new Lesson();
        $lesson->duration = 1;

        return view('lessons.form')
            ->with('education', $lesson_type->term->cohort->education)
            ->with('cohort', $lesson_type->term->cohort)
            ->with('term', $lesson_type->term)
            ->with('lesson_type', $lesson_type)
            ->with('lesson', $lesson)
            ->with('breadcrumbs', $this->breadcrumbs($lesson_type, 'Nieuwe les'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(), [

            'lesson_type' => 'required|integer',
            'week_start' => 'required|integer|between:1,8',
            'duration' => 'required|integer|between:1,8',
            'title' => 'required|string'

        ]);

        $lesson = new Lesson();

        $lesson->week_start = request('week_start');
        $lesson->duration = request('duration');
        $lesson->lesson_type_id = request('lesson_type');
        $lesson->title = request('title');

        $lesson->save();

        return redirect('/terms/' . request('term'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function show(Lesson $lesson)
    {
        if(Auth::user()->type == 'teacher')
        {
            $history = $lesson->reviews;
            $review = $history->first();
            unset($history[0]);
        }
        else
        {
            $history = null;
            $review = $lesson->reviews()
                ->where('review_status_id', Review_status::COMPLETE)
                ->where('sv_do_path', '<>', null)
                ->first();
        }

        return view('lessons.show')
            ->with('education', $lesson->lesson_type->term->cohort->education)
            ->with('cohort', $lesson->lesson_type->term->cohort)
            ->with('term', $lesson->lesson_type->term)
            ->with('lesson_type', $lesson->lesson_type)
            ->with('lesson', $lesson)
            ->with('review', $review)
            ->with('history', $history)
            ->with('breadcrumbs', $this->breadcrumbs($lesson));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function edit(Lesson $lesson)
    {
        return view('lessons.form')
            ->with('education', $lesson->lesson_type->term->cohort->education)
            ->with('cohort', $lesson->lesson_type->term->cohort)
            ->with('term', $lesson->lesson_type->term)
            ->with('lesson_type', $lesson->lesson_type)
            ->with('lesson', $lesson)
            ->with('breadcrumbs', $this->breadcrumbs($lesson, 'Aanpassen'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lesson $lesson)
    {
        
        $this->validate(request(), [

            'week_start' => 'required|integer|between:1,8',
            'duration' => 'required|integer|between:1,8',
            'title' => 'required|string'

        ]);

        $lesson->week_start = request('week_start');
        $lesson->duration = request('duration');
        $lesson->title = request('title');

        $lesson->save();

        return redirect('/lessons/' . $lesson->id);
    }


    public function delete(Lesson $lesson)
    {
        return view('lessons.delete')
            ->with('lesson', $lesson)
            ->with('breadcrumbs', $this->breadcrumbs($lesson, 'Verwijderen'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lesson $lesson)
    {
        foreach($lesson->reviews as $review)
        {
            Storage::disk('spaces')->delete([
                $review->wv_do_path,
                $review->tv_do_path,
                $review->sv_do_path
            ]);
        }

        $term_id = $lesson->lesson_type->term->id;
        $lesson->delete();
        return redirect('/terms/' . $term_id);
    }
}
