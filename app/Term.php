<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    
	protected $appends = ['title'];

	public function cohort()
	{
		return $this->belongsTo(Cohort::class);
	}

	public function lesson_types()
	{
		return $this->hasMany(Lesson_type::class);
	}

	public function getTitleAttribute()
	{
		return 'p' . str_pad($this->order, 2, '0', STR_PAD_LEFT);
	}

}
