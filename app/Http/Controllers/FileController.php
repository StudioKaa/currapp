<?php

namespace App\Http\Controllers;

use App\File;
use App\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lesson = Lesson::find($_GET['lesson']);
        return view('files.create')
            ->with('education', $lesson->lesson_type->term->cohort->education)
            ->with('cohort', $lesson->lesson_type->term->cohort)
            ->with('term', $lesson->lesson_type->term)
            ->with('lesson_type', $lesson->lesson_type)
            ->with('lesson', $lesson);
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
            'file' => 'required|file'

        ]);

        $file = new File();
        $file->lesson_id = request('lesson');
        $file->title = request()->file->getClientOriginalName();

        if($request->hasFile('file'))
        {
            $extension = request()->file->getClientOriginalExtension();
            $filename = 'lesson' . request('lesson') . '_' . uniqid() . '.' . $extension;
            $path = Storage::disk('spaces')->putFileAs('uploads/files', request()->file, $filename, 'private');
        }

        $file->link = $path;
        $file->save();
        return redirect('/lessons/' . request('lesson'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function show(File $file)
    {
        header('Content-Type: ' . Storage::disk('spaces')->getMimeType($file->link));
        header('Content-Disposition: attachment; filename="' . $file->title . '"');
        return Storage::disk('spaces')->get($file->link);
    }

    public function delete(File $file)
    {
        return view('files.delete')
            ->with('file', $file);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function destroy(File $file)
    {
        $lesson_id = $file->lesson->id;
        Storage::disk('spaces')->delete($file->link);
        $file->delete();
        return redirect('/lessons/' . $lesson_id);
    }
}
