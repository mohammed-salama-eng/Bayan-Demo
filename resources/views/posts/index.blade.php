<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Posts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-6">
                <div></div>
                @can('create', App\Models\Post::class)
                    <a href="{{ route('posts.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-md">
                        {{ __('Create Post') }}
                    </a>
                @endcan
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @if($posts->isEmpty())
                        <div class="text-center py-12 text-gray-500 dark:text-gray-400">
                            <p class="text-lg">{{ __('No posts found.') }}</p>
                            @can('create', App\Models\Post::class)
                                <a href="{{ route('posts.create') }}" class="inline-flex mt-4 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-md">
                                    {{ __('Create your first post') }}
                                </a>
                            @endcan
                        </div>
                    @else
                        <div class="space-y-4">
                            @foreach($posts as $post)
                                <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
                                    <div class="flex justify-between items-start gap-4">
                                        <div class="flex-1">
                                            <a href="{{ route('posts.show', $post) }}" class="text-lg font-semibold text-gray-900 dark:text-gray-100 hover:text-indigo-600 dark:hover:text-indigo-400">
                                                {{ $post->title }}
                                            </a>
                                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">{{ Str::limit($post->content, 150) }}</p>
                                            <div class="mt-2 text-xs text-gray-500 dark:text-gray-500">
                                                {{ __('By') }} <span class="font-medium">{{ $post->user->name }}</span> · {{ $post->created_at->diffForHumans() }}
                                            </div>
                                        </div>
                                        <div class="flex gap-2 rtl:gap-reverse shrink-0">
                                            <a href="{{ route('posts.show', $post) }}" class="text-sm text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300">
                                                {{ __('View') }}
                                            </a>
                                            @can('update', $post)
                                                <a href="{{ route('posts.edit', $post) }}" class="text-sm text-amber-600 dark:text-amber-400 hover:text-amber-800 dark:hover:text-amber-300">
                                                    {{ __('Edit') }}
                                                </a>
                                            @endcan
                                            @can('delete', $post)
                                                <form method="POST" action="{{ route('posts.destroy', $post) }}" onsubmit="return confirm('{{ __('Are you sure you want to delete this post?') }}')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-sm text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-300">
                                                        {{ __('Delete') }}
                                                    </button>
                                                </form>
                                            @endcan
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-6">
                            {{ $posts->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
