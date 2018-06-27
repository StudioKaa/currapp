<?php

namespace App\Http\Controllers;

use App\Revision;
use App\Lesson;
use App\User;
use App\Status;
use App\Traits\SaveFiles;
use Illuminate\Http\Request;
use Carbon\Carbon;

class RevisionCreateController extends Controller
{

    use SaveFiles;

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_file(Lesson $lesson)
    {
        return view('revisions.create_file')
            ->with('education', $lesson->lesson_type->term->cohort->education)
            ->with('cohort', $lesson->lesson_type->term->cohort)
            ->with('term', $lesson->lesson_type->term)
            ->with('lesson_type', $lesson->lesson_type)
            ->with('lesson', $lesson)
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
        return view('revisions.create_wiki')
            ->with('education', $lesson->lesson_type->term->cohort->education)
            ->with('cohort', $lesson->lesson_type->term->cohort)
            ->with('term', $lesson->lesson_type->term)
            ->with('lesson_type', $lesson->lesson_type)
            ->with('lesson', $lesson)
            ->with('users', User::all());
    }

    public function store_wiki(Request $request)
    {
        $this->validate(request(), [

            'lesson' => 'required|integer',
            'wiki' => 'required|string'

        ]);

        $wiki_base = 'https://wiki.amo.rocks/wiki/';

        $revision = new Revision();
        $revision->lesson_id = request('lesson');
        $revision->status = Status::COMPLETE;
        $revision->author_id = \Auth::user()->id;
        $revision->type = Revision::TYPE_WIKI;
        $revision->wv_title = 'Wiki: werkversie';
        $revision->wv_path = $wiki_base . request('wiki');
        $revision->tv_title = 'Wiki: docentversie';
        $revision->tv_path = $wiki_base . request('wiki') . '/Docent';
        $revision->sv_title = 'Wiki: studentversie';
        $revision->sv_path = $wiki_base . request('wiki') . '/pdf';

        $revision->save();
        
        return redirect('/lessons/' . request('lesson'));
    }
    
}
