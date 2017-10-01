<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    
	public function cohort()
	{
		return $this->belongsTo(Cohort::class);
	}

	public function lesson_types()
	{
		return $this->hasMany(Lesson_type::class);
	}

}
