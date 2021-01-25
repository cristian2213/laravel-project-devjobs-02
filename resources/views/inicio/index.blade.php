@extends('layouts.app')

@section('navegacion')

@endsection

@section('content')
    <div class="flex flex-col lg:flex-row bg-white shadow">
        <div class=" lg:w-1/2">
            1
        </div>

        <div class="block lg:w-1/2">
            <img src="{{ asset('images/4321.jpg') }}" alt="devJobs">
        </div>
    </div>
@endsection
