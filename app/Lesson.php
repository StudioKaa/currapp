<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Review_status;

class Lesson extends Model
{

	public function lesson_type()
	{
		return $this->belongsTo(Lesson_type::class);
	}

	public function files()
	{
		return $this->hasMany(File::class);
	}

	public function links()
	{
		return $this->hasMany(Link::class);
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

		return $this->reviews->first()->status();
	}

	public function getFileName()
	{
		$string = preg_replace(array('/\s/', '/\.[\.]+/', '/[^\w_\.\-]/'), array('_', '.', ''), $this->title);
		return str_replace(' ', '_', $string);
	}

}
