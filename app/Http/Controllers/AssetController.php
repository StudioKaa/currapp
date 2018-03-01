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
        $asset->type = 'file';
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
        return view('assets.create_link')->with('lesson', $lesson);
    }

    public function store_link(Request $request)
    {
        $this->validate(request(), [

            'lesson' => 'required|integer',
            'title' => 'required',
            'link' => 'required|url',
            'visibility' => 'required|in:student,teacher'

        ]);

        $asset = new Asset();
        $asset->lesson_id = request('lesson');
        $asset->author_id = Auth::user()->id;
        $asset->type = 'link';
        $asset->title = request('title');
        $asset->visibility = request('visibility');
        $asset->link = request('link');
        
        $asset->save();
        return redirect('/lessons/' . request('lesson'));
    }

    public function delete(Lesson $lesson, Asset $asset)
    {
        return view('assets.delete')->with('asset', $asset);
    }

    public function destroy(Lesson $lesson, Asset $asset)
    {
        if($asset->type == 'file')
        {
            Storage::disk('spaces')->delete($asset->link); 
        }
        
        $asset->delete();
        return redirect()->route('lessons.show', $lesson);
    }
}
