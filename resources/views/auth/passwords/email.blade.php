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


                        <form method="POST" action="{{ route('password.email') }}" class="py-5 mx-5" novalidate>
                            @csrf

                            @if (session('status'))
                                <span class="bg-red-100 border-l-4 border-red-500 text-red-700 p-1 my-10 text-sm"
                                    role="alert">
                                    {{-- --}}
                                    <strong>{{ session('status') }}</strong>
                                </span>
                            @endif

                            <div class="flex flex-wrap mb-6">
                                <label for="email"
                                    class="block text-gray-700 text-sm mb-2">{{ __('E-Mail Address') }}</label>

                                <input id="email" type="email"
                                    class="p-2 mt-2 bg-gray-200 rounded form-input w-full @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="bg-red-100 border-l-4 border-red-500 text-red-700 p-1 mt-3 text-sm"
                                        role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>

                            <div class="flex flex-wrap mb-6">
                                <button type="submit"
                                    class="w-full text-xs text-center bg-teal-500 hover:bg-teal-600 focus:outline-none focus:shadow-outline p-3 text-white font-bold uppercase">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
