<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;

use Intervention\Image\ImageManagerStatic as Image;

use App\Models\SocialMedia;

class SocialMediaController extends Controller
{
    public function index()
    {
        $socialMedia = SocialMedia::all();

        return view('backend.social-media.index', compact('socialMedia'));
    }

    public function show($id)
    {
        $socialMedia = SocialMedia::findOrFail($id);

        return view('backend.social-media.show', compact('socialMedia'));
    }

    public function create()
    {
        return view('backend.social-media.create');
    }

    public function store(Request $request)
    {
        $socialMedia = SocialMedia::create();

        $socialMedia->name = $request->name;

        $path = public_path('uploads/social-media');

        if(!File::isDirectory($path))
        {
            File::makeDirectory($path, 0777, true, true);
        }

        $fileName = $socialMedia->id . "." . Input::file('image_url')->getClientOriginalExtension();

        $path = public_path('uploads/social-media/' . $fileName);

        Image::make(Input::file('image_url'))->save($path);

        $socialMedia->image_url = $fileName;

        if($socialMedia->save()){
            return redirect()->route('social-media.index');
        }

    }

    public function edit($id)
    {
        $socialMedia = SocialMedia::findOrFail($id);

        return view('backend.social-media.edit', compact('socialMedia'));
    }

    public function update($id, Request $request)
    {
        $socialMedia = SocialMedia::findOrFail($id);

        $socialMedia->name = $request->name;

        if(Input::file('image_url')){
            $path = public_path('uploads/social-media');

            $fileName = $socialMedia->id . "." . Input::file('image_url')->getClientOriginalExtension();

            $path = public_path('uploads/social-media/' . $fileName);

            Image::make(Input::file('image_url'))->save($path);

            $socialMedia->image_url = $fileName;
        }

        if($socialMedia->save()){
            return redirect()->route('social-media.index');
        }
    }

    public function destroy($id)
    {
        $socialMedia = SocialMedia::findOrFail($id);

        $path = public_path('uploads/social-media/') . $socialMedia->image_url;

        if($socialMedia->delete() && File::delete($path)){
            return redirect()->route('social-media.index');
        }
    }
    public function ValidatorAllFilled(){
      // Validator to check if all fields are filled
    }
    public function ValidatorInsertDBsuccesfull(){
      // Validator to check if the inserting of data into database didnt go wrong in any way
    }
    public function ValidatorHTMLchars(){
      // Validator to check for html special chars, so they cant insert code
    }
    public function ValidatorHandlingError(){
      // Validator that handles the errors that come up with faulty uploads or unsuccesfull upload
    }    
}
