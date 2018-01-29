<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{

    public function lesson()
    {
        return $this->belongsTo(\App\Lesson::class);
    }

}
