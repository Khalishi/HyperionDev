<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">

        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Username -->
            <div>
                <x-input-label for="username" value="Username" />

                <x-text-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')" required autofocus />

                @error('username')
                <x-input-error for="username" :messages="$message" class="mt-2" />
                @enderror


            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" value="Password" />

                <x-text-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />

                @error('password')
                <x-input-error for="password" :messages="$message" class="mt-2" />
                @enderror
            </div>

            <div class="flex items-center justify-end mt-4">

                <x-primary-button class="ml-3">
                    Log in
                </x-primary-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
