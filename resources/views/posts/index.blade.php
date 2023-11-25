<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Posts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="flex justify-between mt-8">
                        <div class="text-2xl font-bold">
                            Liste des Posts
                        </div>

                        <div class="flex items-center space-x-8">
                            <a href="{{ route('posts.create') }}"
                                class="text-gray-500 font-bold py-2 px-4 rounded hover:bg-gray-200 transition">Ajouter un
                                post</a>
                        </div>
                    </div>

                    <div class="mt-6 text-gray-500">
                        <table class="table-auto w-full">
                            <thead>
                                <tr class="uppercase text-left">
                                    <th class="px-4 py-2 border">Username</th>
                                    <th class="px-4 py-2 border">Date de publication</th>
                                    <th class="px-4 py-2 border">Dernière modification</th>
                                    <th class="px-4 py-2 border">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($posts as $post)
                                    <tr class="hover:bg-gray-50 odd:bg-gray-100 hover:odd:bg-gray-200 transition">

                                        <td class="border px-4 py-2">
                                            {{ $post->user->username }}
                                        </td>
                                        <td class="border px-4 py-2">
                                            {{ $post->published_at ? $post->published_at : 'Non publié' }}
                                        </td>
                                        <td class="border px-4 py-2">
                                            {{ $post->updated_at }}
                                        </td>
                                        <td class="border px-4 py-2 space-x-4">
                                            <a href="{{ route('posts.edit', $post->id) }}" class="text-blue-400">Edit</a>
                                            <form action="{{ route('posts.confirm-destroy', $post->id) }}">
                                                <button type="submit" class="text-red-400">Supprimer</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="border px-4 py-2 text-center">Aucun post trouvé.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
