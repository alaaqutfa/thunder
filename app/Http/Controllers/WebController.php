<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebController extends Controller
{
    public function home()
    {
        return view('web.home');
    }

    public function about()
    {
        return view('web.about');
    }

    public function contact()
    {
        return view('web.contact');
    }

    public function projects()
    {
        return view('web.projects.gallery');
    }

    public function project()
    {
        return view('web.projects.single');
    }

    public function services()
    {
        return view('web.services.list');
    }

    public function servicesDetails()
    {
        return view('web.services.details');
    }
}
