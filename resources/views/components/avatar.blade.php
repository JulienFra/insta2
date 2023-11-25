<div {{ $attributes->merge(['class' => 'rounded-full overflow-hidden aspect-square object-cover object-center']) }}>
    @if ($user->avatar_path)
        <img src="{{ asset('storage/' . $user->avatar_path) }}" alt="{{ $user->username }}" class="w-full h-full">
    @else
        <div class="flex items-center justify-center bg-indigo-100">
            <span class="text-2xl font-medium text-indigo-800">{{ $user->username[0] }}</span>
        </div>
    @endif
</div>
