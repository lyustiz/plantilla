<!DOCTYPE html>
  <html lang="{{ str_replace('_', '-', app()->getLocale()) }}"><head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

<!-- Css Principal -->
<link rel="stylesheet" href="{{ mix('css/app.css') }}">

<!-- Material Icons -->
<link rel="stylesheet" href="/assets/googlefonts/css/css.css">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body>

   <div id="app">

            @yield('content')

    </div>

    <script src="{{ mix('/js/app.js') }}"></script>

</body>
</html>
