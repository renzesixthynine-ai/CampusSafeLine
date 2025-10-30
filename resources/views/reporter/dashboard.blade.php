@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900 p-6">
    <div class="max-w-6xl mx-auto space-y-6">

        {{-- Header --}}
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200">Reporter Dashboard</h1>
            <a href="{{ route('reporter.notifications') }}" class="relative">
                🔔
                @if($notifications->where('is_read', false)->count() > 0)
                    <span class="absolute -top-2 -right-2 bg-red-600 text-white text-xs rounded-full px-1">
                        {{ $notifications->where('is_read', false)->count() }}
                    </span>
                @endif
            </a>
        </div>

        {{-- Verification Status --}}
        <div class="p-4 bg-white dark:bg-gray-800 shadow rounded-lg">
            <p class="text-gray-700 dark:text-gray-300">
                Verification Status:
                <span class="font-semibold {{ $user->verified ? 'text-green-600' : 'text-yellow-500' }}">
                    {{ $user->verified ? 'Verified' : 'Pending Verification' }}
                </span>
            </p>
        </div>

        {{-- Cases List --}}
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-200 dark:bg-gray-700">
                    <tr>
                        <th class="p-3">Case ID</th>
                        <th class="p-3">Category</th>
                        <th class="p-3">Status</th>
                        <th class="p-3">Last Updated</th>
                        <th class="p-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($cases as $case)
                        <tr class="border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-900">
                            <td class="p-3">{{ $case->case_id }}</td>
                            <td class="p-3">{{ $case->category }}</td>
                            <td class="p-3">
                                <span class="px-2 py-1 rounded text-sm
                                    {{ $case->status == 'resolved' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                    {{ ucfirst($case->status) }}
                                </span>
                            </td>
                            <td class="p-3">{{ $case->updated_at->diffForHumans() }}</td>
                            <td class="p-3 text-right">
                                <a href="{{ route('reporter.case.view', $case->id) }}" class="text-blue-600 hover:underline">View</a>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="p-4 text-center text-gray-500">No reports yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Footer --}}
        <div class="flex justify-between text-sm text-gray-500 dark:text-gray-400">
            <a href="{{ route('reporter.settings') }}">⚙️ Settings</a>
            <a href="{{ route('about') }}">ℹ️ About Us</a>
        </div>
    </div>
</div>
@endsection
