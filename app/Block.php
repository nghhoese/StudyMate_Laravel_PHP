<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    protected $primaryKey = 'name';
    public $incrementing = false;
    public $timestamps = false;

    public function getAllEC(){
        $totalEC = 0;
        foreach ($this->module as $module){
            $totalEC = $totalEC+$module->assignment->sum('EC');
        }
        return $totalEC;
    }

    public function module()
    {
        return $this->hasMany('App\Module', 'block_name', 'name');
    }
    public function semester()
    {
        return $this->hasMany('App\Semester', 'semester_name', 'name');
    }
}
