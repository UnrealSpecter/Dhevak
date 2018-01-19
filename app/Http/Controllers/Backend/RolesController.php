<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;

use App\Models\Role;
use App\Http\Requests\RolesForm;


class RolesController extends Controller
{
    public function index()
    {
        $roles = Role::all();

        return view('backend.roles.index', compact('roles'));
    }

    public function show($id)
    {
        $role = Role::findorFail($id);

        return view('backend.roles.show', compact('role'));
    }

    public function create()
    {
        return view('backend.roles.create');
    }

// function to store the data we wnna store

    public function store(Request $request)
    {

        $role = Role::create($request->all());

        return redirect()->route('roles.index');

    }

    // function to edit

    public function edit($id)
    {
        $role = Role::findOrFail($id);

        return view('backend.roles.edit', compact('role'));
    }

    public function update($id, Request $request)
    {
        $role = Role::findorFail($id);

        $role->name = $request->name;

        if($role->save()){
            return redirect()->route('roles.index');
        }
    }

    public function destroy($id)
    {
        $role = Role::findorFail($id);

        if($role->delete()){
            return redirect()->route('roles.index');
        }
    }
}
