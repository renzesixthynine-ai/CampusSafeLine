@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-6">
  <h2 class="text-xl font-bold mb-4">Case Details</h2>
  <div class="bg-white dark:bg-gray-800 rounded shadow p-4 mb-6">
    <div class="mb-2"><span class="font-semibold">Case ID:</span> {{ $case->case_id }}</div>
    <div class="mb-2"><span class="font-semibold">Category:</span> {{ $case->category }}</div>
    <div class="mb-2"><span class="font-semibold">Status:</span> {{ ucfirst($case->status) }}</div>
    <div class="mb-2"><span class="font-semibold">Officer:</span> {{ $case->officer->name ?? 'Unassigned' }}</div>
    <div class="mb-2"><span class="font-semibold">Description:</span> {{ $case->description }}</div>
    <div class="mb-2"><span class="font-semibold">Last Updated:</span> {{ $case->updated_at->diffForHumans() }}</div>
  </div>
  <h3 class="font-semibold mb-2">Evidence</h3>
  <ul class="mb-4">
    @forelse($case->evidences as $evidence)
      <li><a href="{{ asset('storage/' . $evidence->file_path) }}" class="text-blue-600 underline" target="_blank">View Evidence</a></li>
    @empty
      <li class="text-gray-500">No evidence uploaded.</li>
    @endforelse
  </ul>
  <h3 class="font-semibold mb-2">Messages</h3>
  <ul>
    @forelse($case->messages as $message)
      <li class="mb-1"><span class="font-semibold">{{ $message->user->name ?? 'User' }}:</span> {{ $message->content }} <span class="text-xs text-gray-400">({{ $message->created_at->diffForHumans() }})</span></li>
    @empty
      <li class="text-gray-500">No messages yet.</li>
    @endforelse
  </ul>
  <div class="mt-6">
    <a href="{{ route('reporter.chat', $case->id) }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Open Chat</a>
  </div>
</div>
@endsection
