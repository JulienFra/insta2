<x-guest-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Posts') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
            <div class="flex justify-between mt-8">
                <div class=" text-2xl">
                    Supprimer le Post
                </div>
            </div>

            <p class="mt-4 text-gray-500">
                Êtes-vous sûr de vouloir supprimer ce post ?
            </p>

            <form method="POST" action="{{ route('admin.posts.destroy', $post->id) }}" class="mt-6">
                @csrf
                @method('DELETE')
                <x-primary-button type="submit">
                    {{ __('Supprimer') }}
                </x-primary-button>
            </form>
        </div>
    </div>
</x-guest-layout>
