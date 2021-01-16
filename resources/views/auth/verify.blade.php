@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-20 text-center">

        <div class="text-2xl my-5">{{ __('Verify Your Email Address') }}</div>

        @if (session('resent'))
            <div class="alert alert-success" role="alert">
                {{ __('A fresh verification link has been sent to your email address.') }}
            </div>
        @endif

        {{ __('Before proceeding, please check your email for a verification link.') }}
        {{ __('If you did not receive the email') }},
        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
            @csrf
            <button type="submit"
                class="w-10/12 mx-auto text-center bg-teal-500 hover:bg-teal-600 focus:outline-none focus:shadow-outline p-4 text-white font-bold text-sm uppercase mt-10 block rounded">{{ __('click here to request another') }}</button>.
        </form>
    </div>

@endsection
