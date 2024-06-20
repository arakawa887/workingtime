<!DOCTYPE html>
<html lang = "ja">
<head>
  <meta charset = "UTF-8">
  <meta name = "viewport" content = "width=device-width, initial-scale = 1.0">
  <title>Document</title>
  <link rel = "stylesheet" href = "{{ asset('css/sanitize.css') }}">
  <link rel = "stylesheet" href = "{{ asset('css/common.css') }}">
  @yield('css')
</head>
<body>
  <header class = "header">
    <div class = "header-inner">
      <h1 class = "topic">Atte</h1>
      @if (Auth::check())
        <div class = "change">
          <form class = "stamp" action = "/" method = "get">
            @csrf
            <button class = "stamp-form__button-submit" type = "submit">ホーム</button>
          </form>
          <form class = "attendance" action = "/attendance" method = "post">
            @csrf
            <button class = "attendance-form__button-submit" type = "submit">日付一覧</button>
          </form>
          <form class = "logout" action = "/logout" method = "post">
            @csrf
            <button class = "logout-form__button-submit">ログアウト</button>
          </form>
        </div>
      @endif
    </div>
  </header>
  <main>@yield('content')</main>
  <footer class = "footer"><div class = "footer_content"><small>Atte,inc.</small></div></footer>
</body>
</html>