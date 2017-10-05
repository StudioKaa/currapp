<?php

namespace App\Http\Controllers;

use App\Review;
use App\Lesson;
use App\User;
use App\Review_status;
use Illuminate\Http\Request;

class ReviewController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $review = new Review();
        $review->author = \Auth::user();

        $lesson = Lesson::find($_GET['lesson']);

        return view('reviews.create')
            ->with('education', $lesson->lesson_type->term->cohort->education)
            ->with('cohort', $lesson->lesson_type->term->cohort)
            ->with('term', $lesson->lesson_type->term)
            ->with('lesson_type', $lesson->lesson_type)
            ->with('lesson', $lesson)
            ->with('review', $review)
            ->with('users', User::all());
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

            'lesson' => 'required|integer',
            'reviewer_id' => 'integer',
            'wv_link' => 'required|url',
            'tv_link' => 'nullable|url',
            'sv_link' => 'nullable|url'

        ]);

        $reviewer_id = request('reviewer_id');
        $reviewer_id = ($reviewer_id == 0) ? null : $reviewer_id;

        $review = new Review();
        $review->lesson_id = request('lesson');
        $review->review_status_id = ($reviewer_id == null) ? 1 : 2;
        $review->author_id = \Auth::user()->id;
        $review->reviewer_id = $reviewer_id; 
        $review->wv_link = request('wv_link');
        $review->tv_link = request('tv_link');
        $review->sv_link = request('sv_link');
        $review->wv_title = "Werkversie";
        $review->tv_title = ($review->tv_link == null) ? null : "Trainersversie";
        $review->sv_title = ($review->sv_link == null) ? null : "Studentversie";

        $review->save();

    return redirect('/lessons/' . request('lesson'));
    }


    public function review(Review $review)
    {
        $review->author = User::find($review->author_id);
        $review->reviewer = \Auth::user();

        return view('reviews.review')
            ->with('education', $review->lesson->lesson_type->term->cohort->education)
            ->with('cohort', $review->lesson->lesson_type->term->cohort)
            ->with('term', $review->lesson->lesson_type->term)
            ->with('lesson_type', $review->lesson->lesson_type)
            ->with('lesson', $review->lesson)
            ->with('review', $review)
            ->with('statuses', Review_status::all());
    }

    public function update_review(Request $request, Review $review)
    {
        $this->validate(request(), [

            'review_status_id' => 'required|integer',
            'comment' => 'nullable|string'

        ]);


        $review->review_status_id = request('review_status_id');
        $review->reviewer_id = \Auth::user()->id;
        $review->comment = request('comment');
        $review->save();

        return redirect('/lessons/' . $review->lesson->id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $review)
    {
        return view('reviews.edit')
            ->with('education', $review->lesson->lesson_type->term->cohort->education)
            ->with('cohort', $review->lesson->lesson_type->term->cohort)
            ->with('term', $review->lesson->lesson_type->term)
            ->with('lesson_type', $review->lesson->lesson_type)
            ->with('lesson', $review->lesson)
            ->with('review', $review);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Review $review)
    {
        $this->validate(request(), [

            'tv_link' => 'nullable|url',
            'sv_link' => 'nullable|url'

        ]);

        $review->tv_link = request('tv_link');
        $review->sv_link = request('sv_link');
        $review->tv_title = ($review->tv_link == null) ? null : "Trainersversie";
        $review->sv_title = ($review->sv_link == null) ? null : "Studentversie";
        $review->save();

        return redirect('/lessons/' . $review->lesson->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review)
    {
        //
    }
}
