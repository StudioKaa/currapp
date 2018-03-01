<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\GetTemporaryUrl;
use Carbon\Carbon;

class Asset extends Model
{

	use GetTemporaryUrl;

    public function author()
    {
        return User::find($this->author_id);
    }

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    public function getLinkAttribute($value)
    {
    	if($this->type == 'file')
    	{
    		return $this->temporaryUrl(Carbon::now()->addMinutes(240), $value);
    	}

    	return $value;
    }
}
