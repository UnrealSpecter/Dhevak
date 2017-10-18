<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'project_id', 'image_url'
    ];

    public function project()
    {
        return $this->belongsTo('App\Models\Project');
    }

}
