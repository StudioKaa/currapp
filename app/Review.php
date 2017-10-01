<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Review_status;

class Review extends Model
{
    public function status()
    {
    	return Review_status::find($this->review_status_id);
    }
}
