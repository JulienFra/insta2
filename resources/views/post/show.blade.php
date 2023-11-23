<x-guest-layout>
    <div>{{$post->user->username}}</div>
    <div><img src="{{ asset('storage/' . $post->img_path) }}" alt="Post Image" class="mt-4 rounded-md"></div>
    <div class="mb-4 text-xs text-gray-500">
        {{ $post->published_at }}
    </div>
    <div>
        {!! \nl2br($post->body) !!}
    </div>

</x-guest-layout>
