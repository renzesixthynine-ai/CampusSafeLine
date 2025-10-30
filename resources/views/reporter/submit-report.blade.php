@extends('layouts.app')

@section('title', 'Submit Report')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="max-w-3xl mx-auto">
        <div class="bg-white shadow sm:rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <h1 class="text-2xl font-semibold text-gray-900 mb-6">Submit a Safety Report</h1>

                <form action="{{ route('report.store') }}" method="POST" class="space-y-6" enctype="multipart/form-data">
                    @csrf

                    <!-- Incident Type -->
                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700">Type of Incident</label>
                        <select id="type" name="type" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                            <option value="">Select an incident type</option>
                            <option value="harassment">Harassment</option>
                            <option value="theft">Theft</option>
                            <option value="vandalism">Vandalism</option>
                            <option value="suspicious">Suspicious Activity</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    <!-- Location -->
                    <div>
                        <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
                        <input type="text" name="location" id="location" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>

                    <!-- Date and Time -->
                    <div>
                        <label for="incident_date" class="block text-sm font-medium text-gray-700">Date and Time of Incident</label>
                        <input type="datetime-local" name="incident_date" id="incident_date" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea id="description" name="description" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Please provide detailed information about the incident..."></textarea>
                    </div>

                    <!-- Anonymous Reporting Option -->
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input id="anonymous" name="anonymous" type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="anonymous" class="font-medium text-gray-700">Submit Anonymously</label>
                            <p class="text-gray-500">Your identity will not be shared with anyone.</p>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-5">
                        <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Submit Report
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
