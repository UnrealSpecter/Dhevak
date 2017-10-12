<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Input;
// use Illuminate\Support\Facades\File;

// use Intervention\Image\ImageManagerStatic as Image;

use App\Models\Project;
// use App\Http\Requests\EventFormRequest;


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
    }

    public function store(EventFormRequest $request)
    {
    }

    public function edit($id)
    {
    }

    public function update($id, EventFormRequest $request)
    {

    }

    public function destroy($id)
    {
    }
}
