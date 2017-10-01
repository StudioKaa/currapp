<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson_type extends Model
{
    
	public function term()
	{
		return $this->belongsTo(Term::class);
	}

	public function lessons()
	{
		return $this->hasMany(Lesson::class);
	}

}
