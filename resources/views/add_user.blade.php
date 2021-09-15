<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('add') }}">
        @csrf

        <!-- Name -->
            <div>
                <x-label for="name"/> Name

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" /><span style="font-size: x-small">The password is generated automatically and sent to the user by email</span>

                <x-input id="password" class="block mt-1 w-full"
                         type="password"
                         name="password"
                         autocomplete="new-password" value="1111111111" disabled/>
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                         type="password"
                         name="password_confirmation" value="1111111111" disabled/>
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="ml-4">
                    {{ __('Add user') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>