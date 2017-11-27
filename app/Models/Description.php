<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Description extends Model
{
    
    protected $fillable = [
        'project_id', 'content'
    ];

    public function project()
    {
        return $this->belongsTo('App\Models\Project');
    }

}
