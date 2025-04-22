@extends('layouts.app')

@section('title','Welcome')

@section('content')
  <header class="flex justify-between items-center mb-8">
    <h1 class="text-2xl font-bold">Developer Portal</h1>
    <nav>
      @guest
        <a href="{{ route('login') }}" class="text-blue-600 mr-4">Login</a>
        <a href="{{ route('register') }}" class="text-green-600">Register</a>
      @else
        <a href="{{ route('dashboard') }}" class="text-yellow-600">Dashboard</a>
      @endguest
    </nav>
  </header>

  <div class="bg-white p-6 rounded shadow">
    <h2 class="text-xl mb-4">How to use the API</h2>
    <p class="mb-2">
      All requests to <code>/api/users</code> must include your API key in the header:
    </p>
    <pre class="bg-gray-100 p-2 rounded mb-4"><code>X-API-KEY: your_32_character_api_key</code></pre>

    <h3 class="font-semibold">Endpoints</h3>
    <ul class="list-disc pl-6 mb-4">
      <li><code>GET  /api/users</code> – List your users</li>
      <li><code>POST /api/users</code> – Create a user</li>
      <li><code>GET  /api/users/{id}</code> – Get a single user</li>
      <li><code>PUT  /api/users/{id}</code> – Update a user</li>
      <li><code>DELETE /api/users/{id}</code> – Delete a user</li>
      <li><code>POST /api/users/login</code> – Authenticate a user</li>
    </ul>

    <h3 class="font-semibold">Example with <code>curl</code></h3>
    <pre class="bg-gray-100 p-2 rounded"><code>curl -X GET http://127.0.0.1:8000/api/users \
  -H "X-API-KEY: your_32_character_api_key"</code></pre>

    <p class="mt-4 text-sm text-gray-600">
      Need help? See the full <a href="https://github.com/basanzietech/developer-portal" class="underline">README on GitHub</a>.
    </p>
  </div>
@endsection
