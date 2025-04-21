@extends('layouts.app')
@section('title','Dashboard')
@section('content')
<div class="bg-white p-6 rounded space-y-4">
  <h2 class="text-xl">Hello, {{ auth()->user()->username }}</h2>
  <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
  <p><strong>API Key:</strong> {{ auth()->user()->api_key ?? 'Not generated' }}</p>
  <form method="POST" action="/api-key/generate">
    @csrf
    <button class="bg-yellow-500 text-white p-2 rounded">Generate API Key</button>
  </form>
  <h3 class="mt-6 text-lg">Your Users</h3>
  <ul id="user-list" class="list-disc pl-5"></ul>
  <form method="POST" action="/logout">
    @csrf
    <button class="bg-red-600 text-white p-2 rounded">Logout</button>
  </form>
</div>

<script>
  // fetch & render users
  fetch('/api/users', {
    headers:{ 'X-API-KEY':'{{auth()->user()->api_key}}' }
  })
  .then(r=>r.json())
  .then(list=>{
    let ul = document.getElementById('user-list');
    list.forEach(u=>{
      let li = document.createElement('li');
      li.textContent = `${u.username} (${u.phone}) – ${u.status}`;
      ul.appendChild(li);
    });
  });
</script>
@endsection
