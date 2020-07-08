<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    public function user(){
       return $this->belongsTo(User::class);
    }

    public function setKeyAttribute($value)
    {
        $this->attributes['key'] = $this->youtubeId($value);
    }
}
