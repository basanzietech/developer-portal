@extends('layouts.app')
@section('title','Dashboard')
@section('content')
<div class="bg-white p-6 rounded space-y-4">
  <h2 class="text-xl">Hello, {{ auth()->user()->username }}</h2>
  <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
  <p><strong>API Key:</strong> {{ $apiKey ?? 'Not generated' }}</p>

  <form method="POST" action="/api-key/generate">
    @csrf
    <button class="bg-yellow-500 text-white p-2 rounded">Generate API Key</button>
  </form>
  <p class="mt-4"><strong>Total users:</strong> {{ $userCount }}</p>

  <form method="POST" action="/logout" class="mt-6">
    @csrf
    <button class="bg-red-600 text-white p-2 rounded">Logout</button>
  </form>
</div>
@endsection
