<?php
namespace App\Traits;
use Illuminate\Support\Facades\Storage;

trait SaveFiles{

	public function save_files($request, $revision)
    {
        //build folder
        $main_folder = \App::environment('local') ? 'test' : 'uploads';
        $path = $main_folder
            . '/' . $revision->lesson->lesson_type->term->cohort->education->title
            . '/' . $revision->lesson->lesson_type->term->cohort->getTitleAttribute(true, '_')
            . '/' . $revision->lesson->lesson_type->term->title;

        //build general filename        
        $filename = $revision->lesson->lesson_type->title;
        $filename .= '_wk' . $revision->lesson->week_start;
        $filename .= '_' . $revision->lesson->getFileName();
        $filename .= '_rev' . $revision->id;
        
        //save wv
        if($request->hasFile('wv_file'))
        {
            $wv_ext = request()->wv_file->getClientOriginalExtension();
            $revision->wv_title = $filename . '.' . $wv_ext;
            $wv_do = $revision->wv_title;
            $revision->wv_path = Storage::disk('spaces')->putFileAs($path, request()->wv_file, $wv_do, 'private');
        }

        //save tv
        if($request->hasFile('tv_file'))
        {
            $tv_ext = request()->tv_file->getClientOriginalExtension();
            $revision->tv_title = $filename . '_TV.' . $tv_ext;
            $tv_do = $revision->tv_title;
            $revision->tv_path = Storage::disk('spaces')->putFileAs($path, request()->tv_file, $tv_do, 'private');
        }

        //save sv
        if($request->hasFile('sv_file'))
        {
            $sv_ext = request()->sv_file->getClientOriginalExtension();
            $revision->sv_title = $filename . '_SV.' . $sv_ext;
            $sv_do = $revision->sv_title;
            $revision->sv_path = Storage::disk('spaces')->putFileAs($path, request()->sv_file, $sv_do, 'private');
        }
        
        $revision->save();
    }

}