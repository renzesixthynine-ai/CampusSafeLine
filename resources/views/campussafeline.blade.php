@extends('layouts.app')

@section('title', 'Welcome to CampusSafeLine')

@section('content')
<div class="relative isolate bg-white dark:bg-gray-900">
    <!-- Hero Section -->
    <div class="mx-auto max-w-7xl px-6 py-24 sm:py-32 lg:flex lg:items-center lg:gap-x-10 lg:px-8 lg:py-40">
        <div class="mx-auto max-w-2xl lg:mx-0 lg:flex-auto">
            <h1 class="mt-10 max-w-lg text-4xl font-bold tracking-tight text-gray-900 dark:text-white sm:text-6xl">
                Making Campus Safety
                <span class="text-indigo-600 dark:text-indigo-400">Accessible</span>
            </h1>
            <p class="mt-6 text-lg leading-8 text-gray-600 dark:text-gray-300">
                CampusSafeLine provides a secure and confidential platform for reporting safety concerns.
                Together, we can create a safer environment for everyone in our campus community.
            </p>
            <div class="mt-10 flex items-center gap-x-6">
                @auth
                    <a href="{{ url('/dashboard') }}"
                       class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        Go to Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}"
                       class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        Get Started
                    </a>
                    <a href="{{ route('register') }}"
                       class="text-sm font-semibold leading-6 text-gray-900 dark:text-white">
                        Create Account <span aria-hidden="true">→</span>
                    </a>
                @endauth
            </div>
        </div>
        <div class="mt-16 sm:mt-24 lg:mt-0 lg:flex-shrink-0 lg:flex-grow">
            <div class="relative mx-auto w-full max-w-lg lg:max-w-xl">
                <!-- Safe Campus Illustration -->
                <div class="absolute -top-8 -left-8 w-72 h-72 bg-indigo-100 dark:bg-indigo-900/30 rounded-full mix-blend-multiply dark:mix-blend-soft-light blur-2xl opacity-70"></div>
                <div class="absolute -bottom-8 -right-8 w-72 h-72 bg-cyan-100 dark:bg-cyan-900/30 rounded-full mix-blend-multiply dark:mix-blend-soft-light blur-2xl opacity-70"></div>
                <img src="{{ asset('images/campus-safety.svg') }}"
                     alt="Campus Safety Illustration"
                     class="relative rounded-2xl bg-white/5 shadow-2xl ring-1 ring-black/10 dark:ring-white/10">
            </div>
        </div>
    </div>

    <!-- Feature Section -->
    <div class="mx-auto max-w-7xl px-6 py-24 sm:py-32 lg:px-8">
        <div class="mx-auto max-w-2xl lg:text-center">
            <h2 class="text-base font-semibold leading-7 text-indigo-600 dark:text-indigo-400">Safer Together</h2>
            <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900 dark:text-white sm:text-4xl">
                Everything you need to ensure campus safety
            </p>
            <p class="mt-6 text-lg leading-8 text-gray-600 dark:text-gray-300">
                Our platform provides comprehensive tools and features to report, track, and resolve safety concerns efficiently.
            </p>
        </div>
        <div class="mx-auto mt-16 max-w-2xl sm:mt-20 lg:mt-24 lg:max-w-none">
            <dl class="grid max-w-xl grid-cols-1 gap-x-8 gap-y-16 lg:max-w-none lg:grid-cols-3">
                <div class="flex flex-col">
                    <dt class="font-semibold text-gray-900 dark:text-white text-lg leading-7">
                        Anonymous Reporting
                    </dt>
                    <dd class="mt-1 flex flex-auto flex-col text-base leading-7 text-gray-600 dark:text-gray-300">
                        <p class="flex-auto">Submit reports anonymously to ensure your privacy and confidentiality.</p>
                    </dd>
                </div>
                <div class="flex flex-col">
                    <dt class="font-semibold text-gray-900 dark:text-white text-lg leading-7">
                        Real-time Updates
                    </dt>
                    <dd class="mt-1 flex flex-auto flex-col text-base leading-7 text-gray-600 dark:text-gray-300">
                        <p class="flex-auto">Stay informed with real-time status updates on reported incidents.</p>
                    </dd>
                </div>
                <div class="flex flex-col">
                    <dt class="font-semibold text-gray-900 dark:text-white text-lg leading-7">
                        Quick Response
                    </dt>
                    <dd class="mt-1 flex flex-auto flex-col text-base leading-7 text-gray-600 dark:text-gray-300">
                        <p class="flex-auto">Direct connection to campus safety officers for rapid response.</p>
                    </dd>
                </div>
            </dl>
        </div>
    </div>
</div>
@endsection
