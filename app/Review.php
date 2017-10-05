<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Review_status;
use App\User;

class Review extends Model
{
    public function status()
    {
    	$status = Review_status::find($this->review_status_id);
    	if($status->title == 'Compleet' && $this->sv_link == null)
		{
			$status = new Review_status();
			$status->title = "Compleet, SV mist";
			$status->context_class = "primary";
		}
		return $status;

    }

    public function reviewer()
    {
    	return User::find($this->reviewer_id);
    }

    public function author()
    {
        return User::find($this->author_id);
    }

    public function lesson()
    {
    	return $this->belongsTo(Lesson::class);
    }
}
