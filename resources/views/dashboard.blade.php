@extends('layouts.app')
@section('content')
<div class="max-w-md mx-auto bg-white p-6 rounded">
    <h2 class="text-2xl mb-4">Dashboard</h2>
    <p><strong>Username:</strong> {{ auth()->user()->username }}</p>
    <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
    <p class="mt-4"><strong>API Key:</strong> {{ auth()->user()->api_key ?? 'Not generated' }}</p>
    <form action="{{ route('api.generate') }}" method="POST" class="mt-4">
        @csrf
        <button class="bg-yellow-500 text-white p-2 rounded">Generate API Key</button>
    </form>
    <form action="{{ route('logout') }}" method="POST" class="mt-4">
        @csrf
        <button class="bg-red-500 text-white p-2 rounded">Logout</button>
    </form>
</div>
@endsection