<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    public $timestamps = false;

    public function teacher()
    {
        return $this->belongsToMany('App\Teacher', 'teacher_has_module', 'module_id','teacher_id');
    }

    public function myTeacher(){
        return $this->hasMany('App\Teacher', 'teacher', 'id');
    }

    public function coordinator()
    {
        return $this->hasMany('App\Teacher', 'coordinator', 'id');
    }

    public function block(){
        return $this->belongsTo('App\Block', 'block_name', 'name');
    }

    public function assignment(){
        return $this->hasMany('App\Assignment', 'module_id', 'id');
    }

}
