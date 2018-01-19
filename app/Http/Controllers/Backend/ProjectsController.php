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
use App\Http\Requests\ProjectsForm;

class ProjectsController extends Controller
{
    public function index()
    {

        $projects = Project::all();
        // dd($projects[0]->descriptions[0]->content);
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
        $projects = Project::all();

        if(count($projects) > 0){
            $lastProject = collect($projects)->last();
            if($lastProject->id % 3 === 2) {
                $verticalProject = true;
            }
            else {
                $verticalProject = false;
            }
        }
        else {
            $verticalProject = false;
        }


        return view('backend.projects.create')->with(compact('roles', 'socialMedia', 'verticalProject'));
    }

    public function store(Request $request)
    {
        $project = Project::create();

        $project->title = $request->title;
        $project->project_url = $request->project_url;

        //attach the correct social media to their respective pivot tables. additional attributes are passed through an array.
        if($request['socialMedia']){
            foreach($request['socialMedia'] as $mediumIndex => $mediumId) {
                $project->social_media()->attach($mediumId, ['social_media_url' => $request['socialMediaUrl'][$mediumIndex]]);
            }
        }

        //attach all roles that are supplied to the project model
        if($request['role']){
            foreach($request['role'] as $role) {
                //you can attach with just the id or the entire model.
                $roleModel = Role::findOrFail($role);
                $project->roles()->attach($roleModel);
            }
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

        //thumbnail path
        $thumbnailPath = public_path('/uploads/thumbnails');
        if(!File::isDirectory($thumbnailPath))
        {
            File::makeDirectory($thumbnailPath, 0777, true, true);
        }

        //thumbnail file name
        $fileName = $project->id . "." . $request->thumbnail_image_url->getClientOriginalExtension();
        $path = public_path('uploads/thumbnails/' . $fileName);
        $thumbnail = InterventionImage::make($request->thumbnail_image_url);

        if($project->id % 2 === 2){
            //resizing width
            $thumbnail->resize(345, null, function ($constraint) {
                $constraint->aspectRatio();
            });

            // resize the image to a height of 200 and constrain aspect ratio (auto width)
            $thumbnail->resize(null, 440, function ($constraint) {
                $constraint->aspectRatio();
            });
        }
        else {
            //resizing width
            $thumbnail->resize(350, null, function ($constraint) {
                $constraint->aspectRatio();
            });

            // resize the image to a height of 200 and constrain aspect ratio (auto width)
            $thumbnail->resize(null, 250, function ($constraint) {
                $constraint->aspectRatio();
            });
        }

        $thumbnail->save($path);

        $project->thumbnail_image_url = $fileName;


        if($project->save()){
            return redirect()->route('projects.index');
        }

    }

    public function edit($id)
    {
        $project = project::findOrFail($id);

        return view('backend.projects.edit', compact('project'));
    }

    public function update($id, Request $request)
    {
      
      $project = Project::findOrFail($id);

      $project->title = $request->title;

      if($request['project_description']){
          foreach($request['project_description'] as $descriptionContent){
              $description = Description::create();
              $description->project_id = $project->id;
              $description->content = $descriptionContent;
              $description->save();
          }
      }

      if($project->save()){
          return redirect()->route('projects.index');
      }
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
