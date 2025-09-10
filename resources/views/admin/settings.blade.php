@extends('layouts.app')

@section('title', 'System Settings')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="max-w-3xl mx-auto">
        <!-- Header -->
        <div class="mb-6">
            <h1 class="text-2xl font-semibold text-gray-900">System Settings</h1>
            <p class="mt-2 text-sm text-gray-700">Manage your application settings and configurations.</p>
        </div>

        <!-- General Settings -->
        <div class="bg-white shadow sm:rounded-lg mb-6">
            <div class="px-4 py-5 sm:p-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">General Settings</h3>
                <form action="#" method="POST" class="space-y-6">
                    {{-- TODO: Add @csrf --}}

                    <!-- Application Name -->
                    <div>
                        <label for="app_name" class="block text-sm font-medium text-gray-700">Application Name</label>
                        <input type="text" name="app_name" id="app_name" value="CampusSafeLine" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>

                    <!-- Contact Email -->
                    <div>
                        <label for="contact_email" class="block text-sm font-medium text-gray-700">Contact Email</label>
                        <input type="email" name="contact_email" id="contact_email" value="contact@campussafeline.edu" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>

                    <!-- Emergency Contact -->
                    <div>
                        <label for="emergency_number" class="block text-sm font-medium text-gray-700">Emergency Contact Number</label>
                        <input type="tel" name="emergency_number" id="emergency_number" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                </form>
            </div>
        </div>

        <!-- Notification Settings -->
        <div class="bg-white shadow sm:rounded-lg mb-6">
            <div class="px-4 py-5 sm:p-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Notification Settings</h3>
                <form action="#" method="POST" class="space-y-6">
                    {{-- TODO: Add @csrf --}}

                    <!-- Email Notifications -->
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input id="email_new_report" name="email_new_report" type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="email_new_report" class="font-medium text-gray-700">New Report Notifications</label>
                                <p class="text-gray-500">Receive email notifications when new reports are submitted.</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input id="email_status_update" name="email_status_update" type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="email_status_update" class="font-medium text-gray-700">Status Update Notifications</label>
                                <p class="text-gray-500">Receive notifications when case statuses are updated.</p>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Security Settings -->
        <div class="bg-white shadow sm:rounded-lg mb-6">
            <div class="px-4 py-5 sm:p-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Security Settings</h3>
                <form action="#" method="POST" class="space-y-6">
                    {{-- TODO: Add @csrf --}}

                    <!-- Session Timeout -->
                    <div>
                        <label for="session_timeout" class="block text-sm font-medium text-gray-700">Session Timeout (minutes)</label>
                        <input type="number" name="session_timeout" id="session_timeout" value="30" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>

                    <!-- Password Requirements -->
                    <div>
                        <label for="min_password_length" class="block text-sm font-medium text-gray-700">Minimum Password Length</label>
                        <input type="number" name="min_password_length" id="min_password_length" value="8" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                </form>
            </div>
        </div>

        <!-- Save Button -->
        <div class="flex justify-end mb-6">
            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700">
                Save Settings
            </button>
        </div>
    </div>
</div>
@endsection
