<x-guest-layout>
    <!-- Logo & Title -->
    <div class="text-center mb-6">
        <div class="flex justify-center">
            <img src="{{ asset('image/logo_remove.png') }}" alt="Logo SWOR" class="h-14 md:h-20">
        </div>
        <h1 class="mt-5 text-lg md:text-2xl font-bold text-blue-700">
            SWOR Monitoring & Control System
        </h1>
    </div>

    <!-- Session Status -->
    @if (session('status'))
        <div class="mb-4 text-sm text-green-600 font-medium text-center">
            {{ session('status') }}
        </div>
    @endif

    <!-- Form -->
    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- Email -->
        <div>
            <label for="email" class="block text-sm font-medium text-blue-700">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-300 text-gray-700" />
            @error('email')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-medium text-blue-700">Password</label>
            <input id="password" type="password" name="password" required
                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-300 text-gray-700" />
            @error('password')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Remember + Forgot -->
        <div class="flex flex-col md:flex-row items-center justify-between gap-3">
            <label class="inline-flex items-center">
                <input id="remember_me" type="checkbox" name="remember"
                    class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-400">
                <span class="ml-2 text-sm text-gray-600">Ingat saya</span>
            </label>

            {{-- @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}"
                    class="text-sm text-blue-600 hover:underline hover:text-blue-800">
                    Lupa password?
                </a>
            @endif --}}
        </div>

        <!-- Submit Button -->
        <div>
            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-lg shadow-md transition duration-200">
                Masuk
            </button>
        </div>
    </form>
</x-guest-layout>

{{-- <x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}
