<a class="flex flex-col h-full space-y-4 bg-white rounded-md shadow-md p-5 w-full hover:shadow-lg hover:scale-105 transition"
    href="{{ route('posts.show', $post) }}">
    <div class="flex mt-8">
        <x-avatar class="h-20 w-20" :user="$post->user" />
        <div class="ml-4 flex flex-col justify-center">
          <div class="text-gray-700">{{ $post->user->username }}</div>
        </div>
      </div>
    <div><img src="{{ asset('storage/' . $post->img_path) }}" alt="Post Image" class="mt-4 rounded-md"></div>
    <div class="flex-grow text-gray-700 text-sm text-justify">
        {{ Str::limit($post->body, 120) }}
    </div>
    <div>
        <span class="text-sm font-semibold mr-2">{{ $post->likes()->count() }} likes</span>
    </div>
    <div class="text-xs text-gray-500">
        {{ $post->published_at->diffForHumans() }}
    </div>

</a>
