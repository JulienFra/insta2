<x-app-layout>
    <div class="flex mt-8">
        <x-avatar class="h-20 w-20" :user="$post->user" />
        <div class="ml-4 flex flex-col justify-center">
          <div class="text-gray-700">{{ $post->user->username }}</div>
        </div>
      </div>
    <div class="mb-4 text-xs text-gray-500">
        <img src="{{ asset('storage/' . $post->img_path) }}" alt="Post Image" class="mb-4 rounded-md">
        {{ $post->published_at }}
    </div>
    <div>
        {!! \nl2br($post->body) !!}
    </div>


</x-app-layout>
