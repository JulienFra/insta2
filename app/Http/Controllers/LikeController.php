<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function like(Post $post)
    {
        if (auth()->user()->id === $post->user->id) {
            return redirect()->back()->with('error', "You can't like your own post.");
        }

        auth()->user()->likes()->create(['post_id' => $post->id]);
        return back();
    }

    public function unlike(Post $post)
    {
        auth()->user()->likes()->where('post_id', $post->id)->delete();
        return back();
    }
}
