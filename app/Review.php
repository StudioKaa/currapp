<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Review_status;
use App\User;

class Review extends Model
{
    const TYPE_FILE = 0;
    const TYPE_WIKI = 1;
    const TYPE_TEXT = 2;

    public function status()
    {
    	$status = Review_status::find($this->review_status_id);
    	if($status->is(Review_status::COMPLETE) && $this->sv_filename == null)
		{
			$status = Review_status::get(Review_status::COMPLETE_SV_MISSING);
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
