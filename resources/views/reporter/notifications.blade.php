@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto p-6">
  <h2 class="text-xl font-bold mb-4">Notifications</h2>
  <div class="bg-white dark:bg-gray-800 rounded shadow p-4">
    <ul>
      @forelse($notifications as $notification)
        <li class="mb-2 flex justify-between items-center">
          <span>{{ $notification->content }}</span>
          @if(!$notification->is_read)
            <span class="text-xs bg-red-600 text-white rounded px-2 py-1">New</span>
          @endif
        </li>
      @empty
        <li class="text-gray-500">No notifications.</li>
      @endforelse
    </ul>
  </div>
</div>
@endsection
