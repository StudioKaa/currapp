<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Review_status;
use App\User;

class Review extends Model
{

    const STATUS_NONE = 0;
    const STATUS_CONCEPT = 1;
    const STATUS_IN_REVIEW = 2;
    const STATUS_COMPLETE = 3;


    public function status()
    {
    	$status = Review_status::find($this->review_status_id);
    	if($status->title == 'Compleet' && $this->sv_filename == null)
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
