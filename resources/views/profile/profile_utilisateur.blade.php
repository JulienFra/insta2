<x-app-layout>
    <h1 class="font-bold text-xl mb-4">{{ $user->username }}'s Profile</h1>

    <div class="flex items-center">
        <div class="w-20 h-20 overflow-hidden rounded-full">
            <img src="{{ asset('storage/' . $user->avatar_path) }}" alt="{{ $user->username }}" class="w-full h-full object-cover">
        </div>
    </div>
    <div class="mt-4">

        <p class="text-gray-500">{{ $user->followers()->count() }} followers</p>
    </div>
    <div class="mt-4">
        @if(session('error'))
            <p class="text-red-500">{{ session('error') }}</p>
        @endif

        @if(auth()->user()->isFollowing($user))
            <form action="{{ route('unfollow', $user) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-full">Ne plus suivre</button>
            </form>
        @else
            <form action="{{ route('follow', $user) }}" method="POST">
                @csrf
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-full">Suivre</button>
            </form>
        @endif
    </div>


    <div class="flex items-center">
    <p>{{ $user->bio }}</p>
    </div>
    <ul class="grid sm:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4 gap-8">
        @foreach ($posts as $post)
            <li>
                <x-post-card :post="$post" />
            </li>
        @endforeach
    </ul>

    <div class="mt-8">
        {{ $posts->links() }}
    </div>
</x-app-layout>
