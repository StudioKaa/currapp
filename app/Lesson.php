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

	public function status()
	{
		if(!$this->reviews->count())
		{
			$status = new Review_status();
			$status->title = "Nieuw";
			$status->context_class = "danger";
			return $status;
		}

		if(Auth::user()->type == 'teacher')
        {
            return $this->reviews->first()->status();
        }
        else
        {
            return $this->reviews()
                ->where('review_status_id', Review::STATUS_COMPLETE)
                ->where('sv_do_path', '<>', null)
                ->first()->status();
        }

		return $this->reviews->first()->status();
	}

	public function getFileName()
	{
		$string = preg_replace(array('/\s/', '/\.[\.]+/', '/[^\w_\.\-]/'), array('_', '.', ''), $this->title);
		return str_replace(' ', '_', $string);
	}

}
