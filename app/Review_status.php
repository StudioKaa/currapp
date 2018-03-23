<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review_status extends Model
{
    
    const NONE = 0;
    const CONCEPT = 1;
    const IN_REVIEW = 2;
    const COMPLETE = 3;
    const COMPLETE_SV_MISSING = 4;
    const NEW = 5;
    const STUDENT_NONE = 6;

    public function is($compare)
    {
    	return ($this->id == $compare) ? true : false;
    }

    public static function get($find)
    {
    	return Review_status::find($find);
    }
}
