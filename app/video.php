<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class video extends Model
{
    public function user(){
       return $this->belongsTo(User::class);
    }

    public function setKeyAttribute($value)
    {
        $this->attributes['key'] = $this->youtubeId($value);
    }
}
