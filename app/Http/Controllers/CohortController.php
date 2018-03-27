<?php

namespace App\Http\Controllers;

use App\Education;
use App\Cohort;
use Illuminate\Http\Request;
use App\Term;

class CohortController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $education = Education::find(request('education'));
        $cohort = new Cohort();

        return view('cohorts.form')
            ->with('education', $education)
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

            'education' => 'required|integer',
            'start_year' => 'required|integer',

        ]);

        $education = Education::find(request('education'));
        $cohort = new Cohort();

        $cohort->education_id = request('education');
        $cohort->start_year = request('start_year');
        $cohort->exam_year = $cohort->start_year + $education->duration;
        $cohort->save();

        if(request('create_terms') == 'yes')
        {
            $terms = $education->duration * $education->terms_per_year;
            for($i = 1; $i <= $terms; $i++)
            {
                $term = new Term();
                $term->cohort_id = $cohort->id;
                $term->order = $i;
                $term->duration = 1;
                $term->save();
            }
        }

        return redirect('/educations/' . request('education'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cohort  $cohort
     * @return \Illuminate\Http\Response
     */
    public function show(Cohort $cohort)
    {
        return view('cohorts.show')
            ->with('education', $cohort->education)
            ->with('cohort', $cohort)
            ->with('terms', $cohort->terms);
    }

    public function delete(Cohort $cohort)
    {
        return view('cohorts.delete')
            ->with('cohort', $cohort);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cohort  $cohort
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cohort $cohort)
    {
        $education_id = $cohort->education->id;
        $cohort->delete();
        return redirect('/educations/' . $education_id);
    }
}
