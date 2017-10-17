<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Image;

class ImagesController extends Controller
{
    public function index()
    {
        $images = Image::all();

        return view('backend.images.index', compact('images'));
    }

    public function show($id)
    {
        $image = Image::findorFail($id);

        return view('backend.images.show', compact('image'));
    }

    public function create()
    {
        return view('backend.images.create');
    }

    public function store(Request $request)
    {
        $image = new Image($request->all());

        if($image->save()){
            return redirect()->route('images.index');
        }
    }

    public function edit($id)
    {
        $image = Image::findOrFail($id);

        return view('backend.images.edit', compact('image'));
    }

    public function update($id, Request $request)
    {
        $image = Image::findorFail($id);

        $image->name = $request->name;

        if($image->save()){
            return redirect()->route('images.index');
        }
    }

    public function destroy($id)
    {
        $image = Image::findorFail($id);

        if($image->delete()){
            return redirect()->route('images.index');
        }
    }
}
