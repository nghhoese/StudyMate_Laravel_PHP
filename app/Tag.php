<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public $timestamps = false;

    public function assignment()
    {
        return $this->belongsToMany('App\Assignment', 'assignment_has_tag', 'assignment_id', 'tag_id');
    }
}
