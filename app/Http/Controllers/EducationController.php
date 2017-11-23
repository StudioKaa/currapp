<?php

namespace App\Http\Controllers;

use App\Education;
use App\Cohort;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

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
            'terms_per_year' => 'required|integer|between:1,10',

        ]);

        $education = new Education();

        $education->title = request('title');
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
        $this->validate(request(), [

            'title' => 'required|alpha_dash'

        ]);

        $education->title = request('title');
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
