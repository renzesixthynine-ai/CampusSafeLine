@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900 p-6">
    <div class="max-w-4xl mx-auto bg-white dark:bg-gray-800 rounded-lg shadow p-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-6">About CampusSafeLine</h1>

        <div class="prose dark:prose-invert max-w-none">
            <p class="text-gray-600 dark:text-gray-300 mb-4">
                CampusSafeLine is dedicated to fostering a safe and secure campus environment by providing a confidential platform for reporting incidents and concerns.
            </p>

            <h2 class="text-xl font-semibold text-gray-700 dark:text-gray-300 mt-6 mb-4">Our Mission</h2>
            <p class="text-gray-600 dark:text-gray-300 mb-4">
                To empower students and staff to report incidents confidentially while ensuring prompt and appropriate responses from campus authorities.
            </p>

            <h2 class="text-xl font-semibold text-gray-700 dark:text-gray-300 mt-6 mb-4">Key Features</h2>
            <ul class="list-disc list-inside text-gray-600 dark:text-gray-300 mb-4">
                <li>Confidential reporting system</li>
                <li>Real-time case tracking</li>
                <li>Direct communication with campus officers</li>
                <li>Evidence upload capability</li>
                <li>24/7 accessibility</li>
            </ul>

            <h2 class="text-xl font-semibold text-gray-700 dark:text-gray-300 mt-6 mb-4">Contact Information</h2>
            <p class="text-gray-600 dark:text-gray-300 mb-4">
                For urgent matters, please contact Campus Security directly:
                <br>Emergency: (123) 456-7890
                <br>Non-Emergency: (123) 456-7891
                <br>Email: security@campus.edu
            </p>
        </div>
    </div>
</div>
@endsection