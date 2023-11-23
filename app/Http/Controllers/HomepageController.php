<?php

namespace App\Http\Controllers;

use App\Models\Post;

class HomepageController extends Controller
{
    public function index()
    {


        return view('homepage.index'
        );
    }
}
