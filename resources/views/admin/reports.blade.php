@extends('layouts.app')

@section('title', 'Reports Analytics')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-gray-900">Reports Analytics</h1>
        <p class="mt-2 text-sm text-gray-700">Comprehensive overview of all reports and their statistics.</p>
    </div>

    <!-- Summary Stats -->
    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3 mb-6">
        <!-- Total Reports -->
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <dt class="text-sm font-medium text-gray-500 truncate">Total Reports (All Time)</dt>
                <dd class="mt-1 text-3xl font-semibold text-gray-900">1,234</dd>
                <div class="mt-2 flex items-center text-sm text-green-600">
                    <span>+12.5% from last month</span>
                </div>
            </div>
        </div>

        <!-- Resolution Rate -->
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <dt class="text-sm font-medium text-gray-500 truncate">Average Resolution Time</dt>
                <dd class="mt-1 text-3xl font-semibold text-gray-900">48h</dd>
                <div class="mt-2 flex items-center text-sm text-green-600">
                    <span>-25% from last month</span>
                </div>
            </div>
        </div>

        <!-- Active Cases -->
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <dt class="text-sm font-medium text-gray-500 truncate">Active Cases</dt>
                <dd class="mt-1 text-3xl font-semibold text-gray-900">89</dd>
                <div class="mt-2 flex items-center text-sm text-yellow-600">
                    <span>+5.3% from last week</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Reports by Type Chart -->
    <div class="bg-white shadow rounded-lg mb-6">
        <div class="px-4 py-5 sm:p-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Reports by Type</h3>
            <div class="h-96 flex items-center justify-center border-2 border-dashed border-gray-300 rounded-lg">
                {{-- Placeholder for chart --}}
                <p class="text-gray-500">Chart visualization will be implemented here</p>
            </div>
        </div>
    </div>

    <!-- Monthly Trends -->
    <div class="bg-white shadow rounded-lg mb-6">
        <div class="px-4 py-5 sm:p-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Monthly Trends</h3>
            <div class="h-96 flex items-center justify-center border-2 border-dashed border-gray-300 rounded-lg">
                {{-- Placeholder for chart --}}
                <p class="text-gray-500">Chart visualization will be implemented here</p>
            </div>
        </div>
    </div>

    <!-- Export Options -->
    <div class="bg-white shadow rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Export Reports</h3>
            <div class="space-y-4 sm:flex sm:space-y-0 sm:space-x-4">
                <button type="button" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700">
                    Export as PDF
                </button>
                <button type="button" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700">
                    Export as Excel
                </button>
                <button type="button" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700">
                    Export as CSV
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
