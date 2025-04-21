@extends('layouts.app')
@section('title','Login')
@section('content')
<form method="POST" action="/login" class="bg-white p-6 rounded">
  @csrf
  <h2 class="text-xl mb-4">Login</h2>
  <input name="email"    type="email"    placeholder="Email"    required class="w-full mb-2 p-2 border rounded">
  <input name="password" type="password" placeholder="Password" required class="w-full mb-4 p-2 border rounded">
  <button type="submit" class="w-full bg-blue-600 text-white p-2 rounded">Login</button>
  <p class="mt-4 text-center"><a href="/register" class="text-blue-600">Register</a></p>
</form>
@endsection
