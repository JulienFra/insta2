<x-guest-layout>
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg p-6">
            <!-- Login Section -->
            <div class="mb-8">
                <h1 class="text-2xl font-semibold mb-4">Connexion</h1>

                <a href="{{ route('login') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Se connecter
                </a>
            </div>

            <!-- Registration Section -->
            <div>
                <h1 class="text-2xl font-semibold mb-4">Inscription</h1>

                <a href="{{ route('register') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    S'inscrire
                </a>
            </div>
        </div>
    </div>
</x-guest-layout>
