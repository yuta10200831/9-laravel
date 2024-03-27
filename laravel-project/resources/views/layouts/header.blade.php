<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <title>@yield('title')</title>
 <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.17/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-blue-100">
 <header class="bg-blue-500 p-4 text-white">
  <div class="container mx-auto flex justify-between items-center">
   <nav class="flex gap-4">
    <a href="/" class="hover:underline">HOME</a>
    <a href="/income" class="hover:underline">収入TOP</a>
    <a href="/spendings" class="hover:underline">支出TOP</a>
   </nav>
  </div>
 </header>

 <main>
  @yield('content')
 </main>
</body>

</html>