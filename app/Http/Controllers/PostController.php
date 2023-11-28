<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PostCreateRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $query = request('query');

    // Récupérer les utilisateurs suivis
    $followingIds = Auth::user()->following->pluck('id');

    // Récupérer les posts des utilisateurs suivis avec le nombre de likes pour chaque post
    $followedPosts = Post::whereIn('user_id', $followingIds)
        ->select('*', DB::raw('(SELECT COUNT(*) FROM likes WHERE post_id = posts.id) AS likes_count'))
        ->orderByDesc('updated_at');

    // Rechercher des posts s'il y a une requête de recherche
    if ($query) {
        $followedPosts->where('title', 'like', '%' . $query . '%');
    }

    // Récupérer les posts avec le plus de likes (ordonnés par le nombre de likes décroissants)
    $popularPosts = Post::select('*', DB::raw('(SELECT COUNT(*) FROM likes WHERE post_id = posts.id) AS likes_count'))
        ->orderByDesc('likes_count');

    // Fusionner les deux collections de posts et trier par date de mise à jour décroissante
    $posts = $followedPosts->union($popularPosts)->orderByDesc('updated_at')->paginate(12);

    return view('post.index', compact('posts'));
}
public function compte()
{
    $user = User::find(Auth::id());
    $posts = $user->posts()
        ->orderByDesc('updated_at')
        ->paginate(12);

    return view(
        'posts.index',
        [
            'posts' => $posts,
        ]
    );
}
public function show($id)
    {
        $post = Post::findOrFail($id);

        return view('post.show', [
            'post' => $post,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        return view('posts.create');
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
        $post->published_at = Carbon::now();
        $post->user_id = Auth::id();
        $post->save();

        return redirect()->route('posts.index');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
{
    return view('posts.edit', compact('post'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        // Ajoutez ici la logique de validation et de mise à jour du post
        $post->update([
            'body' => $request->input('body'),
            // Ajoutez d'autres champs si nécessaire
        ]);

        return redirect()->route('posts.index')->with('success', 'Le post a été mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
{
    $post->likes()->delete();
    $post->delete();

    // Redirige vers la liste des posts ou une autre page après la suppression
    return redirect()->route('posts.index');
}
    public function destroyConfirmation(Post $post)
    {
        return view('posts.confirm-destroy', compact('post'));
    }
    public function search(Request $request)
        {
            $query = $request->input('query');

            $posts = Post::where('body', 'like', "%$query%")
                    ->orWhereHas('user', function ($userQuery) use ($query) {
                        $userQuery->where('username', 'like', "%$query%");
                    })
                    ->paginate(10);

            return view('post.index', compact('posts'));
        }

}


