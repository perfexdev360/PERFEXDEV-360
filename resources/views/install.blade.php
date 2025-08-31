<x-guest-layout>
    <form method="POST" action="{{ route('install.store') }}">
        @csrf

        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">Database Configuration</h2>

        <div class="mt-4">
            <x-input-label for="db_host" :value="__('Host')" />
            <x-text-input id="db_host" name="db_host" type="text" class="mt-1 block w-full" required />
            <x-input-error :messages="$errors->get('db_host')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="db_port" :value="__('Port')" />
            <x-text-input id="db_port" name="db_port" type="text" class="mt-1 block w-full" required />
            <x-input-error :messages="$errors->get('db_port')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="db_database" :value="__('Database')" />
            <x-text-input id="db_database" name="db_database" type="text" class="mt-1 block w-full" required />
            <x-input-error :messages="$errors->get('db_database')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="db_username" :value="__('Username')" />
            <x-text-input id="db_username" name="db_username" type="text" class="mt-1 block w-full" required />
            <x-input-error :messages="$errors->get('db_username')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="db_password" :value="__('Password')" />
            <x-text-input id="db_password" name="db_password" type="password" class="mt-1 block w-full" required />
            <x-input-error :messages="$errors->get('db_password')" class="mt-2" />
        </div>

        <h2 class="mt-8 text-lg font-medium text-gray-900 dark:text-gray-100">Admin User</h2>

        <div class="mt-4">
            <x-input-label for="admin_name" :value="__('Name')" />
            <x-text-input id="admin_name" name="admin_name" type="text" class="mt-1 block w-full" required />
            <x-input-error :messages="$errors->get('admin_name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="admin_email" :value="__('Email')" />
            <x-text-input id="admin_email" name="admin_email" type="email" class="mt-1 block w-full" required />
            <x-input-error :messages="$errors->get('admin_email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="admin_password" :value="__('Password')" />
            <x-text-input id="admin_password" name="admin_password" type="password" class="mt-1 block w-full" required />
            <x-input-error :messages="$errors->get('admin_password')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="admin_password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="admin_password_confirmation" name="admin_password_confirmation" type="password" class="mt-1 block w-full" required />
            <x-input-error :messages="$errors->get('admin_password_confirmation')" class="mt-2" />
        </div>

        <div class="mt-6 flex justify-end">
            <x-primary-button>
                {{ __('Install') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
