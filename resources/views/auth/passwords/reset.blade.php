@extends('layouts.app')

@section('content')
    <div class="container mx-auto max-w-screen-md">
        <div class="flex flex-wrap justify-center">
            <div class="md:w-1/2 order-2 md:order-1">
                <div class="w-full max-w-sm">
                    <div class="flex flex-col break-words bg-white border-2 shadow-md mt-12">
                        <div class="bg-teal-500 text-white uppercase text-center py-3 px-6 mb-0 font-bold">
                            {{ __('Reset Password') }}
                        </div>


                        <form method="POST" action="{{ route('password.update') }}" class="py-5 mx-5">
                            @csrf

                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="flex flex-wrap mb-6">
                                <label for="email"
                                    class="block text-gray-700 text-sm mb-2">{{ __('E-Mail Address') }}</label>

                                <input id="email" type="email"
                                    class="p-2 bg-gray-200 rounded form-input w-full @error('email') is-invalid @enderror"
                                    name="email" value="{{ $email ?? old('email') }}" required autocomplete="email"
                                    autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>

                            <div class="flex flex-wrap mb-6">
                                <label for="password" class="block text-gray-700 text-sm mb-2">{{ __('Password') }}</label>

                                <input id="password" type="password"
                                    class="p-2 bg-gray-200 rounded form-input w-full @error('password') is-invalid @enderror"
                                    name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>

                            <div class="flex flex-wrap mb-6">
                                <label for="password-confirm"
                                    class="block text-gray-700 text-sm mb-2">{{ __('Confirm Password') }}</label>

                                <input id="password-confirm" type="password"
                                    class="p-2 bg-gray-200 rounded form-input w-full" name="password_confirmation" required
                                    autocomplete="new-password">
                            </div>

                            <div class="flex flex-wrap mb-6">
                                <button type="submit"
                                    class="w-full text-center bg-teal-500 hover:bg-teal-600 focus:outline-none focus:shadow-outline p-4 text-white font-bold text-sm uppercase">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
