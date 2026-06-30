<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function index()
    {
        return view('auth.login'); // This assumes you have a view at resources/views/website/index.blade.php
    }
}
