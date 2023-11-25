<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Avatar') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Here you can change your avatar. It will be displayed on your profile and on your articles.') }}
        </p>
    </header>

    <form
        method="post"
        action="{{ route('profile.avatar.update') }}"
        class="mt-6 space-y-6"
        enctype="multipart/form-data"
    >
        @csrf @method('patch')

        <div class="flex flex-col space-y-2">
            <x-avatar :user="$user" class="h-20 w-20"></x-avatar>

            <div class="mt-4">
                <label for="avatar" class="text-indigo-600 hover:underline cursor-pointer">
                    {{ __('Change Avatar') }}
                </label>
                <input type="file" name="avatar" id="avatar" class="hidden">
            </div>
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'avatar-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >
                    {{ __('Avatar Updated.') }}
                </p>
            @endif
        </div>
    </form>
</section>
