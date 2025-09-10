@extends('layouts.app')

@section('title', 'Messages')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="lg:grid lg:grid-cols-12 lg:gap-x-5">
        <!-- Message List Sidebar -->
        <aside class="py-6 px-2 sm:px-6 lg:py-0 lg:px-0 lg:col-span-3">
            <div class="bg-white shadow rounded-lg">
                <!-- Search -->
                <div class="p-4 border-b border-gray-200">
                    <div class="relative rounded-md shadow-sm">
                        <input type="text" class="block w-full pr-10 sm:text-sm border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500" placeholder="Search messages...">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Message List -->
                <nav class="overflow-y-auto" style="max-height: 32rem;">
                    <ul role="list" class="relative divide-y divide-gray-200">
                        {{-- Placeholder for message threads --}}
                        <li class="relative py-5 px-4 hover:bg-gray-50 cursor-pointer">
                            <div class="flex justify-between space-x-3">
                                <div class="min-w-0 flex-1">
                                    <div class="flex items-center space-x-3">
                                        <span class="block">
                                            <h2 class="text-sm font-medium text-gray-900">Case #12345</h2>
                                        </span>
                                    </div>
                                </div>
                                <time datetime="2025-09-11" class="flex-shrink-0 text-sm text-gray-500">1h ago</time>
                            </div>
                            <div class="mt-1">
                                <p class="text-sm text-gray-600 line-clamp-2">Latest message preview will appear here...</p>
                            </div>
                        </li>
                        <!-- More message threads would be listed here -->
                    </ul>
                </nav>
            </div>
        </aside>

        <!-- Message Thread -->
        <div class="space-y-6 sm:px-6 lg:px-0 lg:col-span-9">
            <div class="bg-white shadow rounded-lg min-h-[36rem] flex flex-col">
                <!-- Thread Header -->
                <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                            Case #12345 - Harassment Report
                        </h3>
                        <div class="flex items-center space-x-2">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                Active
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Message Thread -->
                <div class="flex-1 overflow-y-auto p-4 space-y-4">
                    {{-- Placeholder for messages --}}
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <span class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-gray-500">
                                <span class="text-sm font-medium leading-none text-white">R</span>
                            </span>
                        </div>
                        <div class="flex-1 bg-gray-100 rounded-lg px-4 py-2">
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-medium text-gray-900">Reporter</span>
                                <span class="text-sm text-gray-500">12:45 PM</span>
                            </div>
                            <p class="mt-1 text-sm text-gray-900">Message content will appear here...</p>
                        </div>
                    </div>
                    <!-- More messages would be listed here -->
                </div>

                <!-- Message Input -->
                <div class="border-t border-gray-200 p-4">
                    <form class="flex space-x-3">
                        <div class="flex-1">
                            <textarea rows="1" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Type your message..."></textarea>
                        </div>
                        <button type="submit" class="inline-flex items-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700">
                            Send
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
