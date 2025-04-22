<!DOCTYPE html>
<html><head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>@yield('title','Dev Portal')</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css" rel="stylesheet">
</head><body class="bg-gray-100 p-6">
  @if(session('status'))
  <div class="mb-4 p-2 bg-green-100 text-green-800 rounded">
    {{ session('status') }}
  </div>
@endif
  <div class="max-w-xl mx-auto">@yield('content')</div>
</body></html>
