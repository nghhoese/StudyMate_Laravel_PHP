<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    protected $primaryKey = 'name';
    public $incrementing = false;
    public $timestamps = false;

    public function block(){
        return $this->belongsTo('App\Block', 'semester_name', 'name');
    }
}
