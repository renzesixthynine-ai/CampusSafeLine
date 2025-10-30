@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto p-6">
  <h2 class="text-xl font-bold mb-4">Case Chat</h2>
  <div class="bg-white dark:bg-gray-800 rounded shadow p-4 mb-6 h-64 overflow-y-auto">
    @forelse($messages as $message)
      <div class="mb-2">
        <span class="font-semibold">{{ $message->user->name ?? 'User' }}:</span>
        <span>{{ $message->content }}</span>
        <span class="text-xs text-gray-400">({{ $message->created_at->diffForHumans() }})</span>
      </div>
    @empty
      <div class="text-gray-500">No messages yet.</div>
    @endforelse
  </div>
  <form action="{{ route('reporter.chat.send', $case->id) }}" method="POST" class="flex gap-2">
    @csrf
    <input type="text" name="message" class="flex-1 border rounded px-3 py-2" placeholder="Type your message..." required>
    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Send</button>
  </form>
</div>
@endsection
