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
        'title', 'description', 'project_url'
    ];

    public function roles() {
         return $this->belongsToMany('App\Models\Roles');
    }

    // public function images() {
    //      return $this->hasMany('App\Models\Images');
    // }
    //
    // public function socialmedia() {
    //      return $this->hasMany('App\Models\SocialMedia');
    // }

}
