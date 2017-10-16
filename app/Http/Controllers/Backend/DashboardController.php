<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


class DashboardController extends Controller
{
    public function index()
    {
        return view('backend.dashboard.index');
    }
}
