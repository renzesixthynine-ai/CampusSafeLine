@extends('layouts.app')

@section('title', 'Server Error')

@section('content')
<div class="min-h-[50vh] flex flex-col items-center justify-center">
    <div class="text-center">
        <h1 class="text-4xl font-bold text-gray-900 sm:text-5xl">500</h1>
        <p class="mt-4 text-xl text-gray-600">Server Error</p>
        <p class="mt-2 text-gray-500">We're experiencing some technical difficulties. Please try again later.</p>
        <div class="mt-6">
            <a href="{{ route('home') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700">
                Return Home
            </a>
        </div>
    </div>
</div>
@endsection
