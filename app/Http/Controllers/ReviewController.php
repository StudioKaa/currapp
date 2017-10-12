<?php

namespace App\Http\Controllers;

use App\Review;
use App\Lesson;
use App\User;
use App\Review_status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'wv_file' => 'required|file',
            'tv_file' => 'nullable|file',
            'sv_file' => 'nullable|file'

        ]);


        $reviewer_id = request('reviewer_id');
        $reviewer_id = ($reviewer_id == 0) ? null : $reviewer_id;

        $review = new Review();
        $review->lesson_id = request('lesson');
        $review->review_status_id = ($reviewer_id == null) ? 1 : 2;
        $review->author_id = \Auth::user()->id;
        $review->reviewer_id = $reviewer_id; 
        $review->save();

        $this->save_files($request, $review);
        
        return redirect('/lessons/' . request('lesson'));
    }

    public function save_files($request, $review)
    {
        //build general filename
        $filename = date('Ymd');
        $filename .= '_' . $review->lesson->lesson_type->title;
        $filename .= '_' . $review->lesson->lesson_type->term->title;
        $filename .= '_' . $review->lesson->week_start;
        $filename .= '_' . $review->lesson->getFileName();
        
        //save wv
        if($request->hasFile('wv_file'))
        {
            $wv_ext = request()->wv_file->getClientOriginalExtension();
            $review->wv_filename = $filename . '.' . $wv_ext;
            $wv_do = 'review_' . $review->id . '_wv.' . $wv_ext;
            $review->wv_do_path = Storage::disk('spaces')->putFileAs('uploads/reviews', request()->wv_file, $wv_do, 'private');
        }

        //save tv
        if($request->hasFile('tv_file'))
        {
            $tv_ext = request()->tv_file->getClientOriginalExtension();
            $review->tv_filename = $filename . '_TV.' . $tv_ext;
            $tv_do = 'review_' . $review->id . '_tv.' . $tv_ext;
            $review->tv_do_path = Storage::disk('spaces')->putFileAs('uploads/reviews', request()->tv_file, $tv_do, 'private');
        }

        //save sv
        if($request->hasFile('sv_file'))
        {
            $sv_ext = request()->sv_file->getClientOriginalExtension();
            $review->sv_filename = $filename . '_SV.' . $sv_ext;
            $sv_do = 'review_' . $review->id . '_sv.' . $sv_ext;
            $review->sv_do_path = Storage::disk('spaces')->putFileAs('uploads/reviews', request()->sv_file, $sv_do, 'private');
        }
        
        $review->save();
    }

    public function get_file_wv(Review $review)
    {
        header('Content-Type: ' . Storage::disk('spaces')->getMimeType($review->wv_do_path));
        header('Content-Disposition: attachment; filename="' . $review->wv_filename . '"');
        return Storage::disk('spaces')->get($review->wv_do_path);
    }
    public function get_file_tv(Review $review)
    {
        header('Content-Type: ' . Storage::disk('spaces')->getMimeType($review->tv_do_path));
        header('Content-Disposition: attachment; filename="' . $review->tv_filename . '"');
        return Storage::disk('spaces')->get($review->tv_do_path);
    }
    public function get_file_sv(Review $review)
    {
        header('Content-Type: ' . Storage::disk('spaces')->getMimeType($review->sv_do_path));
        header('Content-Disposition: attachment; filename="' . $review->sv_filename . '"');
        return Storage::disk('spaces')->get($review->sv_do_path);
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

            'tv_file' => 'nullable|file',
            'sv_file' => 'nullable|file'

        ]);

        $this->save_files($request, $review);

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
