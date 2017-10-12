<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'website', 'facebook', 'instagram'
    ];

    public function(){
         return $this->hasMany('App\Models\Roles');
    }

    public function(){
         return $this->hasMany('App\Models\Images');
    }
    
    public function(){
         return $this->hasMany('App\Models\SocialMedia');
    }

}
