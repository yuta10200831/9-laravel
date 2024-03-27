<!DOCTYPE html>
<html lang="ja">

<head>
 <meta charset="UTF-8">
 <title>@yield('title')</title>
 <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.17/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
 <header class="bg-blue-500 p-4 text-white">
  <div class="container mx-auto flex justify-between items-center">
   <!-- ナビゲーション -->
   <nav>
    <ul class="flex space-x-4">
     <li><a href="/"
       class="bg-yellow-400 hover:bg-yellow-300 text-blue-800 font-semibold py-2 px-4 border border-yellow-700 rounded shadow">HOME</a>
     </li>
     <li><a href="/incomes"
       class="bg-yellow-400 hover:bg-yellow-300 text-blue-800 font-semibold py-2 px-4 border border-yellow-700 rounded shadow">収入TOP</a>
     </li>
     <li><a href="/spendings"
       class="bg-yellow-400 hover:bg-yellow-300 text-blue-800 font-semibold py-2 px-4 border border-yellow-700 rounded shadow">支出TOP</a>
     </li>
    </ul>
   </nav>
   <!-- ログイン・ログアウトボタン -->
   <div class="flex space-x-4">
    @if(auth()->check())
    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
     class="bg-yellow-400 hover:bg-yellow-300 text-blue-800 font-semibold py-2 px-4 border border-yellow-700 rounded shadow">ログアウト</a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
     @csrf
    </form>
    @else
    <a href="{{ route('login') }}"
     class="bg-yellow-400 hover:bg-yellow-300 text-blue-800 font-semibold py-2 px-4 border border-yellow-700 rounded shadow">ログイン</a>
    @endif
   </div>
  </div>
 </header>
 <main>
  @yield('content')
 </main>
</body>

</html>