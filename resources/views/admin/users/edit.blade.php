<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit User Roles') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="mb-6">
                        <div class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ $user->name }}</div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">{{ $user->email }}</div>
                    </div>

                    <form method="POST" action="{{ route('admin.users.update', $user) }}">
                        @csrf
                        @method('PUT')

                        <div>
                            <x-input-label :value="__('Roles')" />
                            <div class="mt-4 space-y-3">
                                @foreach($roles as $role)
                                    <label class="flex items-center">
                                        <input type="checkbox" name="roles[]" value="{{ $role->id }}" class="rounded border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:bg-gray-900"
                                            @checked($user->hasRole($role->name))>
                                        <span class="ms-2 rtl:ms-0 rtl:me-2 text-sm text-gray-700 dark:text-gray-300">{{ ucfirst($role->name) }}</span>
                                    </label>
                                @endforeach
                            </div>
                            <x-input-error :messages="$errors->get('roles')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-6 rtl:justify-start">
                            <a href="{{ route('admin.users.index') }}" class="me-3 rtl:me-0 rtl:ms-3 text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100">
                                {{ __('Cancel') }}
                            </a>
                            <x-primary-button>
                                {{ __('Update Roles') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
