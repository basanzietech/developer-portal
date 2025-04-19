@extends('layouts.app')
@section('content')
<form action="{{ route('register') }}" method="POST" class="max-w-md mx-auto bg-white p-6 rounded">
    @csrf
    <h2 class="text-2xl mb-4">Register</h2>
    <input name="username" placeholder="Username" required class="w-full mb-2 p-2 border rounded">
    <input type="email" name="email" placeholder="Email" required class="w-full mb-2 p-2 border rounded">
    <input type="password" name="password_confirmation" placeholder="Confirm Password" required class="w-full mb-4 p-2 border rounded">

    <input type="password" name="password" placeholder="Password" required class="w-full mb-4 p-2 border rounded">
    <button type="submit" class="w-full bg-green-500 text-white p-2 rounded">Register</button>
</form>
@endsection