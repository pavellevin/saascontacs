<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('updateMember') }}">
        @csrf

        <!-- Name -->
            <div>
                <x-label for="name"/> Name

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{$user->name}}" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" value="{{$user->email}}" required />
            </div>

            <!-- Phone number -->
            <div class="mt-4">
                <x-label for="phone" :value="__('Phone')" />

                <x-input id="phone" class="block mt-1 w-full" type="phone" name="phone" value="{{$user->phone}}" required />
            </div>

            <!-- Old Email Address -->
            <div class="mt-4">
                <x-input id="old_email" class="block mt-1 w-full" type="hidden" name="old_email" value="{{$user->email}}" required />
            </div>

            <!-- Id User -->
            <div class="mt-4">
                <x-input id="id" class="block mt-1 w-full" type="hidden" name="id" value="{{$user->id}}" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="ml-4">
                    {{ __('Update user') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>