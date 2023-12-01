<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required',
        ]);

        $user = Auth::user();

        $comment = new Comment();
        $comment->user_id = $user->id;
        $comment->content = $request->input('content');

        $post->comments()->save($comment);

        return redirect()->back();
    }

    public function destroy(Comment $comment)
    {
        // Utilisez la méthode delete() pour supprimer le commentaire spécifique
        $comment->delete();

        // Rediriger vers la page précédente ou une autre page après la suppression
        return redirect()->back();
    }
}
