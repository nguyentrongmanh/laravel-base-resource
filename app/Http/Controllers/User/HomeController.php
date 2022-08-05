<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Home page
     *
     * @return \Illuminate\Http\Response
     */
    public function top()
    {
        return view('user.top');
    }
}
