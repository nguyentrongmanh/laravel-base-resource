<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $breadcrumbs = ['Form'];
        return view('admin.form.index', compact('breadcrumbs'));
    }
}
