<x-app-layout>
    <a href="{{ route('profile.show', ['user' => $post->user]) }}" class="flex mt-8">
        <x-avatar class="h-20 w-20" :user="$post->user" />
        <div class="ml-4 flex flex-col justify-center">
            <div class="text-gray-700">{{ $post->user->username }}</div>
        </div>
    </a>

    <div class="mb-4 text-xs text-gray-500">
        <a href="{{ route('posts.show', $post) }}">
            <img src="{{ asset('storage/' . $post->img_path) }}" alt="Post Image" class="mb-4 rounded-md">
        </a>
        {{ $post->published_at }}
    </div>

    <div>
        {!! \nl2br($post->body) !!}
    </div>

    <div class="mt-4">
        <div class="flex items-center mb-2">
            <span class="text-sm font-semibold mr-2">{{ $post->likes()->count() }} likes</span>
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
    </div>

    <!-- ... Autres éléments de la page ... -->

</x-app-layout>
