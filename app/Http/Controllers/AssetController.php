<?php

namespace App\Http\Controllers;

use App\Asset;
use App\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; 
use Auth;

class AssetController extends Controller
{

    public function create_file(Lesson $lesson)
    {
        return view('assets.create_file')->with('lesson', $lesson);
    }

    public function store_file(Request $request)
    {
        $this->validate(request(), [

            'lesson' => 'required|integer',
            'file' => 'required|file',
            'visibility' => 'required|in:student,teacher'

        ]);

        $asset = new Asset();
        $asset->lesson_id = request('lesson');
        $asset->author_id = Auth::user()->id;
        $asset->title = request()->file->getClientOriginalName();
        $asset->visibility = request('visibility');

        if($request->hasFile('file'))
        {
            $extension = request()->file->getClientOriginalExtension();
            $filename = 'asset_lesson' . request('lesson') . '_' . uniqid() . '.' . $extension;
            $path = Storage::disk('spaces')->putFileAs('uploads/files', request()->file, $filename, 'private');
        }

        $asset->link = $path;
        $asset->save();
        return redirect('/lessons/' . request('lesson'));
    }

    public function create_link(Lesson $lesson)
    {
        return view('assets.create')->with('lesson', $lesson);
    }

    public function store_link(Request $request)
    {
        //
    }

    public function show(Lesson $lesson, Asset $asset)
    {
        if($asset->visibility == 'teacher' && Auth::user()->type != 'teacher')
        {
            dd('Geen toegang.');
        }

        return redirect($asset->link);
    }

    public function delete(Asset $asset)
    {
        //
    }

    public function destroy(Asset $asset)
    {
        //
    }
}
