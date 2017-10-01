<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    protected $table = 'educations';

    public function cohorts()
    {

    	return $this->hasMany(Cohort::class)->orderBy('start_year');

    }
}
