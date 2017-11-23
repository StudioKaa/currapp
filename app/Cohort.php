<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cohort extends Model
{

    protected $appends = ['title'];

    public function education()
	{
		return $this->belongsTo(Education::class);
	}

    public function terms()
    {
    	return $this->hasMany(Term::class);
    }

    public function getTitleAttribute($nospaces = false)
    {
        $title = $this->start_year;
        $title .= $nospaces ? '-' : ' - ';
        $title .= $this->exam_year;

        return $title;
    }
}
