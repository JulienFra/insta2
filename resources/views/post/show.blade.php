<x-app-layout>
    <div class="p-8 bg-white rounded shadow-lg">

        <!-- User Info Section -->
        <a href="{{ route('profile.show', ['user' => $post->user]) }}" class="flex items-center mb-4">
            <x-avatar class="h-20 w-20" :user="$post->user" />
            <div class="ml-4">
                <div class="text-xl font-semibold">{{ $post->user->username }}</div>
            </div>
        </a>

        <!-- Post Image Section -->
        <a href="{{ route('posts.show', $post) }}">
            <img src="{{ asset('storage/' . $post->img_path) }}" alt="Post Image" class="mb-4 rounded-lg w-full sm:w-2/3 lg:w-1/2 xl:w-1/3">
        </a>

        <!-- Post Content Section -->
        <div class="text-gray-700 leading-relaxed mb-4">
            {!! nl2br($post->body) !!}
        </div>

        <!-- Like/Unlike Section -->
        <div class="flex items-center mb-4">
            <span class="text-sm font-semibold mr-2">{{ $post->likeCount() }} likes</span>
            @if(auth()->check() && auth()->user()->id !== $post->user->id)
                @if(auth()->user()->hasLiked($post))
                    <form action="{{ route('posts.unlike', $post) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500">Unlike</button>
                    </form>
                @else
                    <form action="{{ route('posts.like', $post) }}" method="POST">
                        @csrf
                        <button type="submit" class="text-blue-500">Like</button>
                    </form>
                @endif
            @else
                <span class="text-gray-500">You can't like your own post</span>
            @endif
        </div>

        <!-- Comments Section -->
        <h2 class="text-2xl font-semibold mb-4">Commentaires</h2>

        @foreach ($post->comments as $comment)
            <div class="flex items-center mb-2">
                <a href="{{ route('profile.show', ['user' => $comment->user]) }}" class="flex items-center">
                    <x-avatar class="h-10 w-10" :user="$comment->user" />
                    <span class="ml-2 text-gray-700">{{ $comment->user->username }}</span>
                </a>
                <span class="ml-4">{{ $comment->content }}</span>

                <!-- Delete Comment Button -->
                @if(auth()->check() && auth()->user()->id === $comment->user->id)
                    <form action="{{ route('comments.destroy', ['comment' => $comment]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="ml-2 text-red-500">Supprimer</button>
                    </form>
                @endif
            </div>
        @endforeach

        <!-- Add Comment Section -->
        <form method="post" action="{{ route('comments.store', ['post' => $post]) }}" class="mt-4">
            @csrf
            <textarea name="content" rows="3" placeholder="Ajouter un commentaire" class="w-full p-2 border rounded"></textarea>
            <button type="submit" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Ajouter</button>
        </form>
    </div>
</x-app-layout>
