@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-gray-900 dark:text-gray-100">
                            <h3 class="text-lg font-semibold">Total Reports</h3>
                            <p class="text-3xl font-bold">{{ $statistics['total_reports'] }}</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-gray-900 dark:text-gray-100">
                            <h3 class="text-lg font-semibold">In Progress</h3>
                            <p class="text-3xl font-bold text-yellow-600">{{ $statistics['in_progress'] }}</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-gray-900 dark:text-gray-100">
                            <h3 class="text-lg font-semibold">Resolved Cases</h3>
                            <p class="text-3xl font-bold text-green-600">{{ $statistics['resolved'] }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Recent Reports -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h2 class="text-xl font-semibold mb-4 text-gray-900 dark:text-gray-100">Recent Reports</h2>
                        <div class="space-y-4">
                            @foreach($recentReports as $report)
                                <div class="border-b border-gray-200 dark:border-gray-700 pb-4">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h3 class="font-medium text-gray-900 dark:text-gray-100">
                                                {{ $report->case_id }}
                                            </h3>
                                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                                {{ Str::limit($report->description, 100) }}
                                            </p>
                                        </div>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $report->status->color() }}">
                                            {{ $report->status->label() }}
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Officer Performance -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h2 class="text-xl font-semibold mb-4 text-gray-900 dark:text-gray-100">Officer Performance</h2>
                        <div class="space-y-4">
                            @foreach($officerPerformance as $officer)
                                <div class="border-b border-gray-200 dark:border-gray-700 pb-4">
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <h3 class="font-medium text-gray-900 dark:text-gray-100">
                                                {{ $officer->name }}
                                            </h3>
                                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                                {{ $officer->resolved_cases }} of {{ $officer->total_cases }} cases resolved
                                            </p>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                                Avg. Resolution Time
                                            </p>
                                            <p class="font-medium text-gray-900 dark:text-gray-100">
                                                {{ number_format($officer->avg_resolution_time, 1) }} hours
                                            </p>
                                        </div>
                                    </div>
                                    <!-- Progress Bar -->
                                    <div class="mt-2 w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                                        <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ ($officer->resolved_cases / $officer->total_cases) * 100 }}%"></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
