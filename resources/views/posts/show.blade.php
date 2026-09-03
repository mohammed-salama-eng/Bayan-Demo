<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $post->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="text-sm text-gray-500 dark:text-gray-400">
                            {{ __('By') }} <span class="font-medium text-gray-700 dark:text-gray-300">{{ $post->user->name }}</span>
                            · {{ $post->created_at->format('M d, Y') }}
                        </div>
                        @if(auth()->id() === $post->user_id || auth()->user()->hasRole('admin'))
                            <div class="flex gap-2 rtl:gap-reverse">
                                <a href="{{ route('posts.edit', $post) }}" class="text-sm text-amber-600 dark:text-amber-400 hover:text-amber-800 dark:hover:text-amber-300">
                                    {{ __('Edit') }}
                                </a>
                                <form method="POST" action="{{ route('posts.destroy', $post) }}" onsubmit="return confirm('{{ __('Are you sure you want to delete this post?') }}')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-sm text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-300">
                                        {{ __('Delete') }}
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>

                    <div class="prose dark:prose-invert max-w-none">
                        {!! nl2br(e($post->content)) !!}
                    </div>

                    <div class="mt-8 pt-4 border-t border-gray-200 dark:border-gray-700">
                        <a href="{{ route('posts.index') }}" class="text-sm text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300">
                            &larr; {{ __('Back to Posts') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
