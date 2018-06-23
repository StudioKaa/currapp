<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Status;
use App\User;

class Revision extends Model
{
    
    const TYPE_FILE = 0;
    const TYPE_WIKI = 1;

    public function getStatusAttribute($value)
    {
        return new Status($value);
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
