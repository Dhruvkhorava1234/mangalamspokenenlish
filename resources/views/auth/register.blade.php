<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        {{-- Hidden redirect field so the controller knows where to send the user after registration --}}
        @if(request('redirect'))
            <input type="hidden" name="redirect" value="{{ request('redirect') }}">
        @endif

        {{-- Prominent "Already registered?" notice --}}
        <div style="background: #eff6ff; border: 1px solid #bfdbfe; border-radius: 0.6rem; padding: 0.85rem 1.1rem; margin-bottom: 1.25rem; display: flex; align-items: center; justify-content: space-between; gap: 1rem;">
            <span style="font-size: 0.9rem; color: #1e40af; font-weight: 600;">
                Already have an account?
            </span>
            <a href="{{ route('login') }}{{ request('redirect') ? '?redirect='.urlencode(request('redirect')) : '' }}"
               style="display: inline-block; background: #2563eb; color: #ffffff; font-size: 0.85rem; font-weight: 700; padding: 0.4rem 1rem; border-radius: 0.4rem; text-decoration: none; white-space: nowrap; transition: background 0.15s;">
                Login here &rarr;
            </a>
        </div>

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Phone Number -->
        <div class="mt-4">
            <x-input-label for="phone" :value="__('Phone Number')" />
            <x-text-input id="phone" class="block mt-1 w-full" type="tel" name="phone" :value="old('phone')" placeholder="e.g. 9033965711" autocomplete="tel" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <!-- Email Address (Optional) -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email (Optional if phone is provided)')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" placeholder="e.g. name@example.com" autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
