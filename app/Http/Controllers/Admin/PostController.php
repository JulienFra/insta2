<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PostCreateRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $posts = Auth::user()->posts()
        ->orderByDesc('updated_at')
        ->get();

    return view(
        'admin.posts.index',
        [
            'posts' => $posts,
        ]
    );
}

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostCreateRequest $request)
    {
        $post = new Post();

        // Utilisez $request->file('img_path') pour accéder au fichier téléchargé
        $imgPath = $request->file('img_path')->store('images', 'public');
        $post->img_path = $imgPath;

        // Accédez aux autres champs directement à partir de la demande
        $post->body = $request->input('body');
        $post->published_at = $request->input('published_at');
        $post->user_id = Auth::id();
        $post->save();

        return redirect()->route('admin');
    }


    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
