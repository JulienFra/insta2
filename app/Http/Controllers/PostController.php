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
use Illuminate\Pagination\LengthAwarePaginator;

class PostController extends Controller
{





    public function index()
    {
        $user = Auth::user();

        $threeDaysAgo = Carbon::now()->subDays(3);

        // Récupérer les posts des utilisateurs que vous suivez publiés au cours des trois derniers jours
        $followedPosts = Post::whereHas('user.followers', function ($query) use ($user) {
                $query->where('follower_id', $user->id);
            })
            ->whereDate('published_at', '>=', $threeDaysAgo)
            ->orderByDesc('published_at')
            ->get();

        // Récupérer les autres posts du plus liké au moins liké
        $remainingPosts = Post::whereNotIn('id', $followedPosts->pluck('id')->toArray())
            ->withCount('likes')
            ->orderByDesc('likes_count')
            ->get();

        // Fusionner les deux collections paginées de posts
        $mergedPosts = $followedPosts->merge($remainingPosts);

        // Paginer la collection fusionnée


        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 10; // Définissez le nombre d'éléments par page selon vos besoins

        $currentPageItems = $mergedPosts->slice(($currentPage - 1) * $perPage, $perPage)->all();

        $postsPaginated = new LengthAwarePaginator(
            $currentPageItems,
            count($mergedPosts),
            $perPage,
            $currentPage,
            ['path' => LengthAwarePaginator::resolveCurrentPath()]
        );

        return view('post.index', [
            'posts' => $postsPaginated,
        ]);
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


