<?php

namespace App\Http\Controllers;

use App\Cohort;
use App\Term;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class TermController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Try to find term in cohort by combined key (cohort_id.term_title).
     */
    public function find($id){
        $keys = explode('.', $id);
        $cohort_id = $keys[0];
        $term_title = $keys[1];

        $term_id = DB::table('terms')
            ->where('cohort_id', $cohort_id)
            ->where('title', $term_title)
            ->value('id');

        if($term_id != null)
        {
            return redirect('/terms/' . $term_id);
        }
        else
        {
            return redirect('/cohorts/' . $cohort_id);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cohort = Cohort::find($_GET['cohort']);
        $term = new Term();
        $term->duration = 1;

        return view('terms.form')
            ->with('term', $term)
            ->with('cohort', $cohort);
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

            'cohort' => 'required|integer',
            'sub_title' => 'present',
            'duration' => 'required|integer|min:1',

        ]);

        $term = new Term();

        $term->cohort_id = request('cohort');
        $term->sub_title = request('sub_title');
        $term->duration = request('duration');

        $term->save();

        return redirect('/cohorts/' . request('cohort'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Term  $term
     * @return \Illuminate\Http\Response
     */
    public function show(Term $term)
    {
        $lesson_types = $term->lesson_types()->orderBy('order')->get();

        return view('terms.show')
            ->with('education', $term->cohort->education)
            ->with('cohort', $term->cohort)
            ->with('term', $term)
            ->with('lesson_types', $lesson_types);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Term  $term
     * @return \Illuminate\Http\Response
     */
    public function edit(Term $term)
    {
        return view('terms.form')
            ->with('term', $term)
            ->with('cohort', $term->cohort);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Term  $term
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Term $term)
    {
        $this->validate(request(), [

            'order' => 'required|integer|min:1',
            'sub_title' => 'present',
            'duration' => 'required|integer|min:1',

        ]);

        $term->order = request('order');
        $term->sub_title = empty(request('sub_title')) ? null : request('sub_title');
        $term->duration = request('duration');

        $term->save();

        return redirect('/terms/' . $term->id);
    }

    function delete(Term $term)
    {
        return view('terms.delete')
            ->with('term', $term);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Term  $term
     * @return \Illuminate\Http\Response
     */
    public function destroy(Term $term)
    {
        $cohort_id = $term->cohort->id;
        $term->delete();
        return redirect('/cohorts/' . $cohort_id);
    }
}
