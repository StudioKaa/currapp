<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    public function author()
    {
        return User::find($this->author_id);
    }
}
