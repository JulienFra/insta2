<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Éditer le Post') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
            <form method="POST" action="{{ route('posts.update', $post->id) }}">
                @csrf
                @method('PUT')

                {{-- Ajoutez ici les champs du formulaire pour l'édition du post --}}
                <label for="body">Contenu du Post</label>
                <textarea name="body" id="body">{{ $post->body }}</textarea>

                <x-primary-button type="submit">
                    {{ __('Mettre à jour') }}
                </x-primary-button>
            </form>
        </div>
    </div>
</x-app-layout>
