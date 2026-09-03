<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold mb-2">{{ __('Welcome back, :name!', ['name' => auth()->user()->name]) }}</h3>
                    <p class="text-gray-600 dark:text-gray-400">
                        {{ __('You are logged in as') }} <span class="font-medium text-indigo-600 dark:text-indigo-400">{{ ucfirst(auth()->user()->getRoleNames()->first()) }}</span>.
                    </p>

                    <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="bg-indigo-50 dark:bg-indigo-900/50 rounded-lg p-4 border border-indigo-200 dark:border-indigo-700">
                            <div class="text-sm text-indigo-600 dark:text-indigo-300">{{ __('Total Posts') }}</div>
                            <div class="text-2xl font-bold text-indigo-800 dark:text-indigo-200">{{ auth()->user()->posts()->count() }}</div>
                        </div>
                        <div class="bg-green-50 dark:bg-green-900/50 rounded-lg p-4 border border-green-200 dark:border-green-700">
                            <div class="text-sm text-green-600 dark:text-green-300">{{ __('Role') }}</div>
                            <div class="text-2xl font-bold text-green-800 dark:text-green-200">{{ ucfirst(auth()->user()->getRoleNames()->first()) }}</div>
                        </div>
                        <div class="bg-purple-50 dark:bg-purple-900/50 rounded-lg p-4 border border-purple-200 dark:border-purple-700">
                            <div class="text-sm text-purple-600 dark:text-purple-300">{{ __('Member Since') }}</div>
                            <div class="text-2xl font-bold text-purple-800 dark:text-purple-200">{{ auth()->user()->created_at->format('M Y') }}</div>
                        </div>
                    </div>

                    <div class="mt-6 flex gap-3">
                        @can('create', App\Models\Post::class)
                            <a href="{{ route('posts.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-md">
                                {{ __('Create Post') }}
                            </a>
                        @endcan
                        <a href="{{ route('posts.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 text-sm font-medium rounded-md">
                            {{ __('View Posts') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
