<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;

// use Intervention\Image\ImageManagerStatic as Image;

use App\Models\Project;
use App\Models\Role;

class ProjectsController extends Controller
{
    public function index()
    {
        $projects = Project::all();

        return view('backend.projects.index', compact('projects'));
    }

    public function show($id)
    {

    }

    public function create()
    {
        $roles = Role::all();

        return view('backend.projects.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $project = new Project();

        $project->title = $request->title;
        $project->description = $request->description;
        $project->project_url = $request->project_url;

        $project->roles()->attach(2);
        $project->roles()->attach(4);
    }

    public function edit($id)
    {
        return view('backend.projects.edit');
    }

    public function update($id, Request $request)
    {

    }

    public function destroy($id)
    {
        $project = Project::find($id);
        if($project->delete()){
            return redirect()->route('projects.index');
        }
    }
}
