<?php

namespace App\Http\Controllers;

use App\Revision;
use App\Lesson;
use App\User;
use App\Status;
use App\Traits\SaveFiles;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReviewCreateController extends Controller
{

    use SaveFiles;

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_file(Lesson $lesson)
    {
        $revision = new Revision();
        $revision->author = \Auth::user();

        return view('revisions.create_file')
            ->with('education', $lesson->lesson_type->term->cohort->education)
            ->with('cohort', $lesson->lesson_type->term->cohort)
            ->with('term', $lesson->lesson_type->term)
            ->with('lesson_type', $lesson->lesson_type)
            ->with('lesson', $lesson)
            ->with('review', $revision)
            ->with('statuses', Status::getPickables());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_file(Request $request)
    {
        $this->validate(request(), [

            'lesson' => 'required|integer',
            'status_id' => 'required|integer',
            'wv_file' => 'required|file',
            'tv_file' => 'nullable|file',
            'sv_file' => 'nullable|file'

        ]);
        
        $revision = new Revision();
        $revision->lesson_id = request('lesson');
        $revision->status = request('status_id');
        $revision->author_id = \Auth::user()->id;
        $revision->type = Revision::TYPE_FILE;
        $revision->save();

        $this->save_files($request, $revision);
        
        return redirect('/lessons/' . request('lesson'));
    }

    public function create_wiki(Lesson $lesson)
    {
        $review = new Review();
        $review->author = \Auth::user();

        return view('reviews.create_wiki')
            ->with('education', $lesson->lesson_type->term->cohort->education)
            ->with('cohort', $lesson->lesson_type->term->cohort)
            ->with('term', $lesson->lesson_type->term)
            ->with('lesson_type', $lesson->lesson_type)
            ->with('lesson', $lesson)
            ->with('review', $review)
            ->with('users', User::all());
    }

    public function store_wiki(Request $request)
    {
        $this->validate(request(), [

            'lesson' => 'required|integer',
            'wiki' => 'required|string'

        ]);

        $wiki_base = 'https://wiki.amo.rocks/wiki/';

        $review = new Review();
        $review->lesson_id = request('lesson');
        $review->review_status_id = Review_status::COMPLETE;
        $review->author_id = \Auth::user()->id;
        $review->type = Review::TYPE_WIKI;
        $review->reviewer_id = null; 
        $review->wv_filename = 'Wiki: werkversie';
        $review->wv_do_path = $wiki_base . request('wiki');
        $review->tv_filename = 'Wiki: docentversie';
        $review->tv_do_path = $wiki_base . request('wiki') . '/Docent';
        $review->sv_filename = 'Wiki: studentversie';
        $review->sv_do_path = $wiki_base . request('wiki') . '/pdf';

        $review->save();
        
        return redirect('/lessons/' . request('lesson'));
    }

    // public function create_text(Lesson $lesson)
    // {
    //     $review = new Review();
    //     $review->author = \Auth::user();

    //     return view('reviews.create_text')
    //         ->with('education', $lesson->lesson_type->term->cohort->education)
    //         ->with('cohort', $lesson->lesson_type->term->cohort)
    //         ->with('term', $lesson->lesson_type->term)
    //         ->with('lesson_type', $lesson->lesson_type)
    //         ->with('lesson', $lesson)
    //         ->with('review', $review)
    //         ->with('users', User::where('type', 'teacher')->get());
    // }

    // public function store_text(Request $request)
    // {
    //     $this->validate(request(), [

    //         'lesson' => 'required|integer',
    //         'message' => 'required|string'

    //     ]);

    //     $review = new Review();
    //     $review->lesson_id = request('lesson');
    //     $review->review_status_id = Review_status::COMPLETE;
    //     $review->author_id = \Auth::user()->id;
    //     $review->type = Review::TYPE_TEXT;
    //     $review->comment = $request->message;
    //     $review->sv_filename = 'type_of_text';
    //     $review->sv_do_path = 'type_of_text';

    //     $review->save();
        
    //     return redirect('/lessons/' . request('lesson'));
    // }
}
