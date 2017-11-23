<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    
	protected $appends = ['title', 'year', 'order_in_year'];

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

	public function getYearAttribute()
	{
		return ceil($this->order / $this->cohort->education->terms_per_year);
	}

	public function getOrderInYearAttribute()
	{
		return $this->order - ($this->cohort->education->terms_per_year * ($this->year-1));
	}

}
