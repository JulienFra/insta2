<x-app-layout>
    <form action="{{ route('post.search') }}" method="GET" class="mb-4">
        <label for="query">Search:</label>
        <input type="text" name="query" id="query" value="{{ request('query') }}">
        <button type="submit">Search</button>
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
        <p>Aucun résultat trouvé.</p>
    @endif
</x-app-layout>
