<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Revision;
use App\Status;
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

	public function revisions()
	{
		return $this->hasMany(Revision::class)->orderBy('created_at', 'desc');
	}

	public function has_reader_for_student()
	{
		return $this->revisions()
                ->where('status', Status::COMPLETE)
                ->where('sv_path', '<>', null)
                ->count() ? true : false;
	}

	public function current_revision()
	{
		if(Auth::user()->type == 'student')
		{
			return $this->revisions()
                ->where('status_id', Status::COMPLETE)
                ->where('sv_path', '<>', null)
                ->first();
		}

		return $this->revisions()->first();
	}

	public function status()
	{
		$revision = $this->current_revision();
		$user = Auth::user();

		if($revision == null)
		{
			return ($user->type == 'student') 
				? new Status(Status::NO_READER)
				: new Status(Status::NEW);
		}

		if($revision->status->is(Status::CONCEPT) && $this->has_reader_for_student())
		{
			return new Status(Status::COMPLETE_WITH_CONCEPT);
		}

		return $revision->status;
	}

	public function getFileName()
	{
		$string = preg_replace(array('/\s/', '/\.[\.]+/', '/[^\w_\.\-]/'), array('_', '.', ''), $this->title);
		return str_replace(' ', '_', $string);
	}

}
