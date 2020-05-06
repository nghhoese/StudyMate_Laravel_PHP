<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false;

    public function assignment()
    {
        return $this->belongsTo('App\Assignment', 'assignment_id', 'id');
    }
}
