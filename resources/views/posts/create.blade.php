<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Posts') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
            <div class="flex justify-between mt-8">
                <div class=" text-2xl">
                    Créer un post
                </div>
            </div>

            <form method="POST" action="{{ route('posts.store') }}" class="flex flex-col space-y-4 text-gray-500" enctype="multipart/form-data">

                @csrf

                <div class="mb-4">
                    <label for="img_path" class="block text-gray-700 text-sm font-bold mb-2">{{ __('Image du post') }}</label>
                    <input type="file" id="img_path" name="img_path" class="w-full border rounded p-2 @error('img_path') border-red-500 @enderror">

                    @error('img_path')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>


                <div>
                    <x-input-label for="body" :value="__('Texte de l\'article')" />
                    <textarea id="body"
                        class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                        name="body" rows="10">{{ old('body') }}</textarea>
                    <x-input-error :messages="$errors->get('body')" class="mt-2" />
                </div>

                <div class="flex justify-end">
                    <x-primary-button type="submit">
                        {{ __('Créer') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
