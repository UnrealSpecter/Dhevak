<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class ExperimentalController extends Controller
{
    public function index()
    {
        return view('experimental.index');
    }
}
