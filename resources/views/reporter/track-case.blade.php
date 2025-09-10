@extends('layouts.app')

@section('title', 'Track Case')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="max-w-3xl mx-auto">
        <!-- Case Lookup Form -->
        <div class="bg-white shadow sm:rounded-lg mb-8">
            <div class="px-4 py-5 sm:p-6">
                <h1 class="text-2xl font-semibold text-gray-900 mb-6">Track Your Case</h1>

                {{-- TODO: Update form action to route('report.track.show') --}}
                <form action="#" method="GET" class="space-y-6">
                    <div>
                        <label for="case_id" class="block text-sm font-medium text-gray-700">Case ID</label>
                        <div class="mt-1 flex rounded-md shadow-sm">
                            <input type="text" name="case_id" id="case_id" class="flex-1 min-w-0 block w-full px-3 py-2 rounded-md border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Enter your case ID">
                            <button type="submit" class="ml-3 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Track
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Case Details (Placeholder) -->
        <div class="bg-white shadow sm:rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <div class="border-b border-gray-200 pb-5">
                    <h2 class="text-lg font-medium text-gray-900">Case Details</h2>
                    <p class="mt-2 text-sm text-gray-500">Case ID: XXXXXXX</p>
                </div>

                <!-- Status Timeline -->
                <div class="flow-root mt-6">
                    <ul role="list" class="-mb-8">
                        {{-- Timeline items will be populated here --}}
                        <li>
                            <div class="relative pb-8">
                                <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                                <div class="relative flex space-x-3">
                                    <div>
                                        <span class="h-8 w-8 rounded-full bg-green-500 flex items-center justify-center ring-8 ring-white">
                                            <!-- Placeholder for status icon -->
                                            <span class="text-white">✓</span>
                                        </span>
                                    </div>
                                    <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                        <div>
                                            <p class="text-sm text-gray-500">Report Submitted</p>
                                        </div>
                                        <div class="text-right text-sm whitespace-nowrap text-gray-500">
                                            <time datetime="2025-09-11">Sep 11, 2025</time>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <!-- Additional timeline items would be added here -->
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
