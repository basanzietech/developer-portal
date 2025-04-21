@extends('layouts.app')
@section('title','Register')
@section('content')
<form method="POST" action="/register" class="bg-white p-6 rounded">
  @csrf
  <h2 class="text-xl mb-4">Register</h2>
  <input name="username" type="text"     placeholder="Username" required class="w-full mb-2 p-2 border rounded">
  <input name="email"    type="email"    placeholder="Email"    required class="w-full mb-2 p-2 border rounded">
  <input name="password" type="password" placeholder="Password" required class="w-full mb-2 p-2 border rounded">
  <input name="password_confirmation" type="password" placeholder="Confirm Password" required class="w-full mb-4 p-2 border rounded">
  <button type="submit" class="w-full bg-green-600 text-white p-2 rounded">Register</button>
  <p class="mt-4 text-center"><a href="/login" class="text-blue-600">Login</a></p>
</form>
@endsection
