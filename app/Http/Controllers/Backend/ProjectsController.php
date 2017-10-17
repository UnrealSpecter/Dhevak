<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;

use Intervention\Image\ImageManagerStatic as Image;

use App\Models\Project;
use App\Models\Role;
use App\Models\SocialMedia;

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
        $project = Project::create();

        $project->title = $request->title;
        $project->description = $request->description;
        $project->project_url = $request->project_url;

        foreach($request['role'] as $role){
            //you can attach with just the id or the entire model.
            $roleModel = Role::findOrFail($role);
            $project->roles()->attach($roleModel);
        }

        $path = public_path('uploads/images');

        if(!File::isDirectory($path))
        {
            File::makeDirectory($path, 0777, true, true);
        }

        foreach($request['image_url'] as $uploadedImage){

            $image = SocialMedia::create();

            $fileName = $image->id . "." . $uploadedImage->getClientOriginalExtension();
            $path = public_path('uploads/images/' . $fileName);
            Image::make($uploadedImage)->save($path);
            $image->image_url = $fileName;

            $image->save();
        }

        if($project->save()){
            return redirect()->route('projects.index');
        }

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
        $project = Project::findOrFail($id);

        // $path = public_path('uploads/projects/') . $event->background_image;
        // File::delete($path);

        if($project->delete()){
            return redirect()->route('projects.index');
        }
    }
}
