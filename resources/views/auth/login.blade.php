<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    {{-- Show a "Register" nudge when the user arrived from the buy flow --}}
    @if(request('redirect'))
    <div style="background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 0.6rem; padding: 0.85rem 1.1rem; margin-bottom: 1.25rem; display: flex; align-items: center; justify-content: space-between; gap: 1rem;">
        <span style="font-size: 0.9rem; color: #166534; font-weight: 600;">
            New here? Create a free account to continue.
        </span>
        <a href="{{ route('register') }}?redirect={{ urlencode(request('redirect')) }}"
           style="display: inline-block; background: #16a34a; color: #ffffff; font-size: 0.85rem; font-weight: 700; padding: 0.4rem 1rem; border-radius: 0.4rem; text-decoration: none; white-space: nowrap;">
            Register &rarr;
        </a>
    </div>
    @endif

    <!-- Demo Credentials Helper Card -->
    <!-- <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 0.5rem; padding: 0.75rem 1rem; margin-bottom: 1.25rem; font-size: 0.8rem;">
        <strong style="color: #0b2545; display: block; margin-bottom: 0.25rem;">Demo Accounts Quick Click:</strong>
        <div style="display: flex; gap: 0.5rem; margin-top: 0.4rem; flex-wrap: wrap;">
            <button type="button" onclick="document.getElementById('login').value='admin@example.com'; document.getElementById('password').value='password';" style="background: #e0f2fe; color: #0369a1; font-weight: 700; padding: 0.25rem 0.5rem; border-radius: 4px; font-size: 0.75rem;">
                Fill Admin (admin@example.com)
            </button>
            <button type="button" onclick="document.getElementById('login').value='student@example.com'; document.getElementById('password').value='password';" style="background: #ecfdf5; color: #047857; font-weight: 700; padding: 0.25rem 0.5rem; border-radius: 4px; font-size: 0.75rem;">
                Fill Student (student@example.com)
            </button>
        </div>
    </div> -->

    <form method="POST" action="{{ route('login') }}">
        @csrf

        {{-- Carry the redirect through the login form --}}
        @if(request('redirect'))
            <input type="hidden" name="redirect" value="{{ request('redirect') }}">
        @endif

        <!-- Email or Phone Number -->
        <div>
            <x-input-label for="login" :value="__('Email or Phone Number')" />
            <x-text-input id="login" class="block mt-1 w-full" type="text" name="login" :value="old('login')" placeholder="Enter your email or 10-digit mobile" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('login') ?: $errors->get('email')" class="mt-2" />
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
</x-guest-layout>
