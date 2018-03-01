<?php

namespace App\Http\Controllers;

use App\Review;
use App\Lesson;
use App\User;
use App\Review_status;
use App\Traits\SaveFiles;
use App\Traits\GetTemporaryUrl;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReviewController extends Controller
{
    
    use SaveFiles, GetTemporaryUrl;

    public function get_file_wv(Review $review)
    {
        if($review->type == Review::TYPE_WIKI)
        {
            return redirect($review->wv_do_path);
        }

        $time = Carbon::now()->addMinutes(10);
        return redirect($this->temporaryUrl($time, $review->wv_do_path));
    }
    public function get_file_tv(Review $review)
    {
        if($review->type == Review::TYPE_WIKI)
        {
            return redirect($review->tv_do_path);
        }

        $time = Carbon::now()->addMinutes(10);
        return redirect($this->temporaryUrl($time, $review->tv_do_path));
    }
    public function get_file_sv(Review $review)
    {
        if($review->type == Review::TYPE_WIKI)
        {
            return redirect($review->sv_do_path);
        }

        $time = Carbon::now()->addMinutes(1);
        return redirect($this->temporaryUrl($time, $review->sv_do_path));
    }

    public function review_form(Review $review)
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

    public function review_store(Request $request, Review $review)
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

    public function addfiles_form(Review $review)
    {
        return view('reviews.addfiles')
            ->with('education', $review->lesson->lesson_type->term->cohort->education)
            ->with('cohort', $review->lesson->lesson_type->term->cohort)
            ->with('term', $review->lesson->lesson_type->term)
            ->with('lesson_type', $review->lesson->lesson_type)
            ->with('lesson', $review->lesson)
            ->with('review', $review);
    }

    public function addfiles_store(Request $request, Review $review)
    {
        $this->validate(request(), [

            'tv_file' => 'nullable|file',
            'sv_file' => 'nullable|file'

        ]);

        $this->save_files($request, $review);

        return redirect('/lessons/' . $review->lesson->id);
    }
}
