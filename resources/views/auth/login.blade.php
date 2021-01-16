@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <div class="flex flex-wrap justify-center">
            <div class="w-full max-w-sm">
                <div class="flex flex-col break-words bg-white border-2 shadow-md mt-12">
                    <div class="bg-teal-500 text-white uppercase text-center py-3 px-6 mb-0 font-bold">
                        {{ __('Login') }}
                    </div>
                    <form method="POST" action="{{ route('login') }}" class="py-10 px-5" novalidate>
                        @csrf

                        <div class="flex flex-wrap mb-6">
                            <label for="email" class="block text-gray-700 text-sm mb-2">{{ __('E-Mail Address') }}</label>

                            <input id="email" type="email"
                                class="p-3 bg-gray-100 rounded form-input w-full @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" autocomplete="email" autofocus>

                            @error('email')
                                <span class="bg-red-100 border-l-4 border-red-500 text-red-700 p-1 mt-3 text-sm" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>

                        <div class="flex flex-wrap mb-6">
                            <label for="password" class="block text-gray-700 text-sm mb-2">{{ __('Password') }}</label>

                            <input id="password" type="password"
                                class="p-3 bg-gray-100 rounded form-input w-full @error('password') is-invalid @enderror"
                                name="password" autocomplete="current-password">

                            @error('password')
                                <span class="bg-red-100 border-l-4 border-red-500 text-red-700 p-1 mt-3 text-sm" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>


                        <div class="flex flex-wrap mb-6">

                            <input class="mr-3" type="checkbox" name="remember" id="remember"
                                {{ old('remember') ? 'checked' : '' }}>

                            <label for="remember" class="block text-gray-700 text-sm mb-2">
                                {{ __('Remember Me') }}
                            </label>

                        </div>

                        <div class="flex flex-wrap mb-6">

                            <button type=" submit"
                                class="bg-teal-500 w-full hover:teal-700 text-gray-100 p-3 hover:bg-teal-600 focus:outline-none focus:shadow-outline uppercase font-bold">
                                {{ __('Login') }}
                            </button>

                            @if (Route::has('password.request'))
                                <a class="text-sm text-gray-500 mt-5 text-center w-full"
                                    href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection