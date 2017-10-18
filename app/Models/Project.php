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

    public function descriptions() {
            return $this->hasMany('App\Models\Description');
    }

    public function roles() {
         return $this->belongsToMany('App\Models\Role');
    }

    public function social_media() {
        return $this->belongsToMany('App\Models\SocialMedia')->withPivot('social_media_url');
    }

    public function images() {
        return $this->hasMany('App\Models\Image');
    }

}
