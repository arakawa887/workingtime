<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
  <link rel="stylesheet" href="{{ asset('css/common.css') }}">
  @yield('css')
</head>
<body>
  <header class="header">
    <div class="header-inner">
      <h1 class="topic">Atte</h1>
    </div>
    <div>@yield('logout')</div>
  </header>
  <main>@yield('content')</main>
  <footer class="footer"><div class="footer_content"><small>Atte,inc.</small></div></footer>
</body>
</html>