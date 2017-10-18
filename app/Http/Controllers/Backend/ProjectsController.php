<?php

namespace App\Http\Controllers\Backend;

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

        return view('backend.projects.index', compact('projects'));
    }

    public function show($id)
    {
        $project = Project::findOrFail($id);

        return view('backend.projects.show', compact('project'));
    }

    public function create()
    {
        $roles = Role::all();
        $socialMedia = SocialMedia::all();

        return view('backend.projects.create')->with(compact('roles', 'socialMedia'));
    }

    public function store(Request $request)
    {
        $project = Project::create();

        $project->title = $request->title;
        $project->description = $request->description;
        $project->project_url = $request->project_url;

        //attach the correct social media to their respective pivot tables. additional attributes are passed through an array.
        foreach($request['socialMedia'] as $mediumIndex => $mediumId) {
            $project->social_media()->attach($mediumId, ['social_media_url' => $request['socialMediaUrl'][$mediumIndex]]);
        }

        //attach all roles that are supplied to the project model
        foreach($request['role'] as $role) {
            //you can attach with just the id or the entire model.
            $roleModel = Role::findOrFail($role);
            $project->roles()->attach($roleModel);
        }

        //add project description
        if($request['project_description']){
            foreach($request['project_description'] as $descriptionContent){
                $description = Description::create();
                $description->project_id = $project->id;
                $description->content = $descriptionContent;
                $description->save();
            }
        }

        //if there are images supplied store them
        if($request['image_url']){

            //check if path exists otherwise make it.
            $path = public_path('uploads/images');
            if(!File::isDirectory($path))
            {
                File::makeDirectory($path, 0777, true, true);
            }

            //make a new image model. Store the file name. Upload the image through intervention and save the url to the img in the model.
            foreach($request['image_url'] as $uploadedImage){
                $image = Image::create();

                $fileName = $image->id . "." . $uploadedImage->getClientOriginalExtension();
                $path = public_path('uploads/images/' . $fileName);
                InterventionImage::make($uploadedImage)->save($path);

                $image->image_url = $fileName;
                $image->project_id = $project->id;

                $image->save();
            }

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

        foreach($project->images as $image){
            $path = public_path('uploads/images/') . $image->image_url;
            File::delete($path);
        }

        if($project->delete()){
            return redirect()->route('projects.index');
        }
    }
}
