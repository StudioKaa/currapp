<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    public function lesson()
    {
    	return $this->belongsTo(Lesson::class);
    }
}
