<x-app-layout>
    <div class="p-8 bg-white rounded shadow-lg">

        <!-- User Info Section -->
        <h1 class="font-bold text-2xl mb-4">{{ $user->username }}'s Profile</h1>

        <div class="flex items-center mb-4">
            <x-avatar class="h-20 w-20" :user="$user" />
        </div>

        <div class="flex items-center mb-4">
            <p class="text-gray-500">{{ $count_follower }} followers</p>
        </div>

        @if(session('error'))
            <p class="text-red-500 mb-4">{{ session('error') }}</p>
        @endif

        <!-- Follow/Unfollow Section -->
        <div class="mb-4">
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

        <!-- User Bio Section -->
        <div class="mb-4">
            <h2 class="text-lg font-semibold mb-2">Bio</h2>
            <div class="border border-gray-300 p-4 min-h-20">
                <p class="text-gray-700">{{ $user->bio }}</p>
            </div>
        </div>

        <!-- User Posts Section -->
        <ul class="grid sm:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4 gap-8">
            @foreach ($posts as $post)
                <li>
                    <x-post-card :post="$post" />
                </li>
            @endforeach
        </ul>

        <!-- Pagination Section -->
        <div class="mt-8">
            {{ $posts->links() }}
        </div>
    </div>
</x-app-layout>
