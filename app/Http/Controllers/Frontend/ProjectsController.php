<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;

use Intervention\Image\ImageManagerStatic as InterventionImage;

use App\Models\Project;
use App\Models\Role;
use App\Models\SocialMedia;
use App\Models\Image;
use App\Models\Description;

class ProjectsController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        
        return view('partials.video-base', compact('projects'));
    }

}
