@extends('layouts.app')
@section('content')
<form action="{{ route('login') }}" method="POST" class="max-w-md mx-auto bg-white p-6 rounded">
    @csrf
    <h2 class="text-2xl mb-4">Login</h2>
    <input type="email" name="email" placeholder="Email" required class="w-full mb-2 p-2 border rounded">
    <input type="password" name="password" placeholder="Password" required class="w-full mb-4 p-2 border rounded">
    <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded">Login</button>
</form>
@endsection