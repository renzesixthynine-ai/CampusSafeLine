@extends('layouts.app')

@section('title', 'Frequently Asked Questions')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="max-w-3xl mx-auto">
        <div class="bg-white shadow sm:rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <h1 class="text-2xl font-semibold text-gray-900 mb-6">Frequently Asked Questions</h1>

                <div class="space-y-6">
                    <!-- FAQ Item -->
                    <div class="border-b border-gray-200 pb-6">
                        <h3 class="text-lg font-medium text-gray-900">How do I submit a report?</h3>
                        <p class="mt-2 text-gray-500">
                            Click on the "Submit Report" button in the navigation menu. Fill out the form with as much detail as possible about the incident. You can choose to submit anonymously if you prefer.
                        </p>
                    </div>

                    <!-- FAQ Item -->
                    <div class="border-b border-gray-200 pb-6">
                        <h3 class="text-lg font-medium text-gray-900">How can I track my case?</h3>
                        <p class="mt-2 text-gray-500">
                            After submitting a report, you'll receive a unique case ID. Use this ID in the "Track Case" section to view updates on your report's status.
                        </p>
                    </div>

                    <!-- FAQ Item -->
                    <div class="border-b border-gray-200 pb-6">
                        <h3 class="text-lg font-medium text-gray-900">Is my information kept confidential?</h3>
                        <p class="mt-2 text-gray-500">
                            Yes, all reports are handled with strict confidentiality. You can also choose to submit reports anonymously if you prefer not to share your identity.
                        </p>
                    </div>

                    <!-- FAQ Item -->
                    <div class="border-b border-gray-200 pb-6">
                        <h3 class="text-lg font-medium text-gray-900">What happens after I submit a report?</h3>
                        <p class="mt-2 text-gray-500">
                            Our safety officers review each report and initiate appropriate action based on the nature of the incident. You can track the progress using your case ID.
                        </p>
                    </div>

                    <!-- FAQ Item -->
                    <div>
                        <h3 class="text-lg font-medium text-gray-900">Who should I contact in an emergency?</h3>
                        <p class="mt-2 text-gray-500">
                            For immediate emergencies, always call 911 first. For campus-specific emergencies, contact Campus Security at {{-- TODO: Add campus security number --}}.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
