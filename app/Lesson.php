<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Review_status;
use Auth;

class Lesson extends Model
{
    
	public function lesson_type()
	{
		return $this->belongsTo(Lesson_type::class);
	}

	public function assets()
	{
		$assets = $this->hasMany(Asset::class);
		if(Auth::user()->type == 'student')
		{
			$assets = $assets->where('visibility', 'student');
		}

		return $assets;
	}

	public function reviews()
	{
		return $this->hasMany(Review::class)->orderBy('created_at', 'desc');
	}

	public function has_reader_for_student()
	{
		return ($this->reviews()
                ->where('review_status_id', Review_status::COMPLETE)
                ->where('sv_do_path', '<>', null)
                ->first() != null) ? true : false;
	}

	public function current_review()
	{
		if(Auth::user()->type == 'student')
		{
			return $this->reviews()
                ->where('review_status_id', Review_status::COMPLETE)
                ->where('sv_do_path', '<>', null)
                ->first();
		}

		return $this->reviews()->first();
	}

	public function status()
	{
		$review = $this->current_review();

		if($review == null)
		{
			return (Auth::user()->type == 'student') ? Review_status::get(Review_status::NO_READER) : Review_status::get(Review_status::NEW);
		}

		if($review->status()->is(\App\Review_status::CONCEPT) && $this->has_reader_for_student())
		{
			return Review_status::get(Review_status::COMPLETE_WITH_CONCEPT);
		}

		return $review->status();
	}

	public function getFileName()
	{
		$string = preg_replace(array('/\s/', '/\.[\.]+/', '/[^\w_\.\-]/'), array('_', '.', ''), $this->title);
		return str_replace(' ', '_', $string);
	}

}
