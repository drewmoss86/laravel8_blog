<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Andrew's Blog</title>

  <link rel="stylesheet" href="{{'css/app.css'}}">
</head>
<body class="bg-gray-100">
  <nav class="p-6 bg-white flex justify-between mb-6">  {{-- Justify-between puts spaces between each ul--}}
    <ul class="flex items-center">
      <li><a href="{{ route('home') }}" class="p-3">Home</a></li>
      <li><a href="{{ route('dashboard') }}" class="p-3">Dashboard</a></li>
      <li><a href="{{ route('post') }}" class="p-3">Post</a></li>
    </ul>
    <ul class="flex items-center">
      {{-- Authentication directive --}}
      @auth
        <li><a href="" class="p-3">{{ auth()->user()->name }}</a></li>
        <li>
          {{-- <a href="{{ route('logout') }}" class="p-3">Logout</a> **VULNERABLE TO CSRF --}}
          <form action="{{ route('logout') }}" method="post"  class="p-3 inline">
            @csrf
            <button type="submit">Logout</button>
          </form>
        </li>      
      @endauth

      @guest
        <li><a href="{{ route('register') }}" class="p-3">Register</a></li>
        <li><a href="{{ route('login') }}"  class="p-3">Login</a></li>       
      @endguest
      {{-- End Authentication directive --}}
    </ul>
  </nav>
  @yield('content')
</body>
</html>