<?php

namespace App\Http\Controllers;

use App\Revision;
use App\Traits\SaveFiles;
use App\Traits\GetTemporaryUrl;
use Illuminate\Http\Request;
use Carbon\Carbon;

class RevisionController extends Controller
{
    
    use SaveFiles, GetTemporaryUrl;

    public function get_file_wv(Revision $revision)
    {
        if($revision->type == Revision::TYPE_WIKI)
        {
            return redirect($revision->wv_path);
        }

        $time = Carbon::now()->addMinutes(10);
        return redirect($this->temporaryUrl($time, $revision->wv_path));
    }
    public function get_file_tv(Revision $revision)
    {
        if($revision->type == Revision::TYPE_WIKI)
        {
            return redirect($revision->tv_path);
        }

        $time = Carbon::now()->addMinutes(10);
        return redirect($this->temporaryUrl($time, $revision->tv_path));
    }
    public function get_file_sv(Revision $revision)
    {
        if($revision->type == Revision::TYPE_WIKI)
        {
            return redirect($revision->sv_path);
        }

        $time = Carbon::now()->addMinutes(1);
        return redirect($this->temporaryUrl($time, $revision->sv_path));
    }

    public function addfiles_form(Revision $revision)
    {
        return view('revisions.addfiles')
            ->with('education', $revision->lesson->lesson_type->term->cohort->education)
            ->with('cohort', $revision->lesson->lesson_type->term->cohort)
            ->with('term', $revision->lesson->lesson_type->term)
            ->with('lesson_type', $revision->lesson->lesson_type)
            ->with('lesson', $revision->lesson)
            ->with('revision', $revision);
    }

    public function addfiles_store(Request $request, Revision $revision)
    {
        $this->validate(request(), [

            'tv_file' => 'nullable|file',
            'sv_file' => 'nullable|file'

        ]);

        $this->save_files($request, $revision);

        return redirect('/lessons/' . $revision->lesson->id);
    }
}
