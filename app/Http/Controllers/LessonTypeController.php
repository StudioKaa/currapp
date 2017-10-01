<?php

namespace App\Http\Controllers;

use App\Term;
use App\Lesson_type;
use Illuminate\Http\Request;

class LessonTypeController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $term = Term::find($_GET['term']);
        $lesson_type = new Lesson_type();

        return view('lesson_types.form')
            ->with('education', $term->cohort->education)
            ->with('cohort', $term->cohort)
            ->with('term', $term)
            ->with('lesson_type', $lesson_type);
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

            'term' => 'required|integer',
            'title' => 'required|alpha_dash',
            'sub_title' => 'present',
            'order' => 'required|integer|min:1'

        ]);

        $lesson_type = new lesson_type();

        $lesson_type->term_id = request('term');
        $lesson_type->title = request('title');
        $lesson_type->sub_title = request('sub_title');
        $lesson_type->order = request('order');

        $lesson_type->save();

        return redirect('/terms/' . request('term'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Lesson_type  $lesson_type
     * @return \Illuminate\Http\Response
     */
    public function edit(Lesson_type $lesson_type)
    {
        return view('lesson_types.form')
            ->with('education', $lesson_type->term->cohort->education)
            ->with('cohort', $lesson_type->term->cohort)
            ->with('term', $lesson_type->term)
            ->with('lesson_type', $lesson_type);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Lesson_type  $lesson_type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lesson_type $lesson_type)
    {
        $this->validate(request(), [

            'title' => 'required|alpha_dash',
            'sub_title' => 'present',
            'order' => 'required|integer|min:1'

        ]);

        $lesson_type->title = request('title');
        $lesson_type->sub_title = empty(request('sub_title')) ? null : request('sub_title');
        $lesson_type->order = request('order');

        $lesson_type->save();

        return redirect('/terms/' . $lesson_type->term->id);
    }

    public function delete(Lesson_type $lesson_type)
    {
        return view('lesson_types.delete')
            ->with('lesson_type', $lesson_type);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Lesson_type  $lesson_type
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lesson_type $lesson_type)
    {
        $term_id = $lesson_type->term->id;
        $lesson_type->delete();
        return redirect('/terms/' . $term_id);
    }
}
