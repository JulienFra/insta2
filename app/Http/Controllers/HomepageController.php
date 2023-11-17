<?php

namespace App\Http\Controllers;

use App\Models\Post;

class HomepageController extends Controller
{
    public function index()
    {
        $posts = Post::simplePaginate(10);

        return view('homepage.index', [
            'posts' => $posts,
        ]);
    }
}
