<?php

namespace App\Http\Controllers;
use App\Lesson;
use App\Link;
use Illuminate\Http\Request;

class LinkController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lesson = Lesson::find($_GET['lesson']);
        return view('links.create')
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
            'title' => 'required',
            'link'   => 'required|url'

        ]);

        $link = new Link();
        $link->title = $request->get('title');
        $link->link = $request->get('link');
        $link->lesson_id = $request->get('lesson');
        $link->save();

        return redirect('/lessons/' . request('lesson'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $link = Link::find($id);
        $link->delete();
        return redirect()->back()->with('message', 'Link succesfully deleted');
    }
}
