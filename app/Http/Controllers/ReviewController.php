<?php

namespace App\Http\Controllers;

use App\Review;
use App\Lesson;
use App\User;
use App\Review_status;
use App\Traits\SaveFiles;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReviewController extends Controller
{
    
    use SaveFiles;

    public function get_file_wv(Review $review)
    {
        if($review->type == Review::TYPE_WIKI)
        {
            return redirect($review->wv_do_path);
        }

        header('Content-Type: ' . Storage::disk('spaces')->getMimeType($review->wv_do_path));
        header('Content-Disposition: attachment; filename="' . $review->wv_filename . '"');
        return Storage::disk('spaces')->get($review->wv_do_path);
    }
    public function get_file_tv(Review $review)
    {
        if($review->type == Review::TYPE_WIKI)
        {
            return redirect($review->tv_do_path);
        }

        header('Content-Type: ' . Storage::disk('spaces')->getMimeType($review->tv_do_path));
        header('Content-Disposition: attachment; filename="' . $review->tv_filename . '"');
        return Storage::disk('spaces')->get($review->tv_do_path);
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

    private function temporaryUrl($expires, $do_path)
    {
        $config = config('filesystems.disks')['spaces'];
        $request = "GET\n\n\n{$expires->timestamp}\n/{$config['bucket']}/{$do_path}";
        $signature = urlencode(base64_encode(hash_hmac('sha1', $request, $config['secret'], true)));
        return "{$config['endpoint']}{$config['bucket']}/{$do_path}?AWSAccessKeyId={$config['key']}&Expires={$expires->timestamp}&Signature={$signature}";
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
