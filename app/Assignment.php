<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    public $timestamps = false;

    public function module()
    {
        return $this->belongsTo('App\Module', 'module_id','id');
    }
    public function teacher()
    {
        return $this->hasMany('App\Teacher', 'id','teacher_id');
    }

    public function category()
    {
        return $this->hasMany('App\Category', 'id','category_id');
    }
    public function tag(){
        return $this->belongsToMany('App\Tag', 'assignment_has_tag', 'assignment_id','tag_id');
    }
}
