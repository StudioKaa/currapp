<?php
namespace App\Traits;
use Illuminate\Support\Facades\Storage;

trait SaveFiles{

	public function save_files($request, $review)
    {
        //build folder
        $main_folder = \App::environment('local') ? 'test' : 'uploads';
        $path = $main_folder
            . '/' . $review->lesson->lesson_type->term->cohort->education->title
            . '/' . $review->lesson->lesson_type->term->cohort->getTitleAttribute(true, '_')
            . '/' . $review->lesson->lesson_type->term->title;

        //build general filename        
        $filename = $review->lesson->lesson_type->title;
        $filename .= '_wk' . $review->lesson->week_start;
        $filename .= '_' . $review->lesson->getFileName();
        $filename .= '_rev' . $review->id;
        
        //save wv
        if($request->hasFile('wv_file'))
        {
            $wv_ext = request()->wv_file->getClientOriginalExtension();
            $review->wv_filename = $filename . '.' . $wv_ext;
            $wv_do = $review->wv_filename;
            $review->wv_do_path = Storage::disk('spaces')->putFileAs($path, request()->wv_file, $wv_do, 'private');
        }

        //save tv
        if($request->hasFile('tv_file'))
        {
            $tv_ext = request()->tv_file->getClientOriginalExtension();
            $review->tv_filename = $filename . '_TV.' . $tv_ext;
            $tv_do = $review->tv_filename;
            $review->tv_do_path = Storage::disk('spaces')->putFileAs($path, request()->tv_file, $tv_do, 'private');
        }

        //save sv
        if($request->hasFile('sv_file'))
        {
            $sv_ext = request()->sv_file->getClientOriginalExtension();
            $review->sv_filename = $filename . '_SV.' . $sv_ext;
            $sv_do = $review->sv_filename;
            $review->sv_do_path = Storage::disk('spaces')->putFileAs($path, request()->sv_file, $sv_do, 'private');
        }
        
        $review->save();
    }

}