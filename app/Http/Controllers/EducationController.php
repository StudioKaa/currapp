<?php

namespace App\Http\Controllers;

use App\Education;
use App\Cohort;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $educations = Education::all();
        return view('educations.index')
            ->with('educations', $educations);
    }

    public function now($slug)
    {
        $education = Education::where('title', $slug)->first();
        $schoolyear = (date('m') > 6) ? date('Y') : date('Y')-1;
        
        $terms = array();
        for($i = 0; $i < $education->duration; $i++)
        {
            $studyyear = $i+1;
            $cohort = $education->cohorts()->where('start_year', $schoolyear-$i)->first();
            if($cohort != null)
            {
                $term = $cohort->terms()
                    ->whereBetween('order', [$education->terms_per_year*$i+1, $education->terms_per_year*$studyyear])
                    ->get();
                if(count($term))
                {
                    $terms[$studyyear] = $term;
                }
            }
        }

        return view('educations.now')
            ->with('education', $education)
            ->with('terms', $terms);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $education = new Education();
        return view('educations.form')
            ->with('education', $education);
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

            'title' => 'required|alpha_dash',
            'duration' => 'required|integer|min:1',
            'terms_per_year' => 'required|integer|min:1',

        ]);

        $education = new Education();

        $education->title = request('title');
        $education->sub_title = request('sub_title');
        $education->duration = request('duration');
        $education->terms_per_year = request('terms_per_year');

        $education->save();

        return redirect('/educations');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Education  $education
     * @return \Illuminate\Http\Response
     */
    public function show(Education $education)
    {           
        
        return view('educations.show')
            ->with('education', $education)
            ->with('cohorts', $education->cohorts);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Education  $education
     * @return \Illuminate\Http\Response
     */
    public function edit(Education $education)
    {
        return view('educations.form')
            ->with('education', $education);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Education  $education
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Education $education)
    {
        $education->sub_title = request('sub_title');
        $education->save();
        return redirect('/educations/' . $education->id);
    }

    public function delete(Education $education)
    {
        return view('educations.delete')
            ->with('education', $education);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Education  $education
     * @return \Illuminate\Http\Response
     */
    public function destroy(Education $education)
    {
        $education->delete();
        return redirect('/educations');
    }
}
