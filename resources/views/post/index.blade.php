<x-app-layout>
    <div class="p-8 bg-white rounded shadow-lg">

        <!-- Search Form -->
        <form action="{{ route('post.search') }}" method="GET" class="mb-8">
            <div class="flex items-center border border-gray-300 rounded-md p-2">
                <label for="query" class="mr-2">Search:</label>
                <input type="text" name="query" id="query" value="{{ request('query') }}" class="border-none focus:outline-none w-full">
                <button type="submit" class="ml-2 bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none">Search</button>
            </div>
        </form>

        <h1 class="font-bold text-xl mb-4">Liste des posts</h1>

        @if($posts->count() > 0)
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
        @else
            <p class="text-gray-500">Aucun résultat trouvé.</p>
        @endif
    </div>
</x-app-layout>
