<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <input id="remember_me" type="checkbox" class="form-checkbox" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-jet-button class="ml-4">
                    {{ __('Login') }}
                </x-jet-button>
            </div>
        </form>

        <hr class="mt-4">

        <div class="flex items-center justify-center mt-4">
            <a class="btn bg-transparent hover:bg-black text-black hover:text-white py-2 px-4 border border-gray-500 hover:border-transparent rounded w-full text-center" href="{{ route('social', ['github']) }}">
                <i class="fab fa-github"></i>
                {{ __('Login with Github') }}
            </a>
        </div>

        <div class="flex items-center justify-center mt-4">
            <a class="btn bg-transparent hover:bg-blue-500 text-blue-500 hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded w-full text-center" href="{{ route('social', ['twitter']) }}">
                <i class="fab fa-twitter"></i>
                {{ __('Login with Twitter') }}
            </a>
        </div>
        
        <div class="flex items-center justify-center mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('register') }}">
                {{ __('Don\'t have an account yet? Sign up.') }}
            </a>
        </div>
    </x-jet-authentication-card>
</x-guest-layout>
