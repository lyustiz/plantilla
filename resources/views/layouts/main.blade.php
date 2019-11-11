<!DOCTYPE html>
  <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="icon" type="image/x-icon" href="/images/list.svg">
	
    <!-- Css Principal -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
	
    <!-- Material Icons -->
    <link rel="stylesheet" href="/assets/googlefonts/css/css.css">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
	
	<!--WEB SERVICE DICOM-->
    <meta name="BANDES_BCV_COD" content="{{ env('BANDES_BCV_COD') }}">
    <meta name="WEB_SERVICE" content="{{ env('WEB_SERVICE') }}">
    <meta name="WS_DICOM_TOKEN" content="{{ env('WS_DICOM_TOKEN') }}">
    <meta name="WS_DICOM_1" content="{{ env('WS_DICOM_1') }}">
    <meta name="WS_DICOM_2" content="{{ env('WS_DICOM_2') }}">
    <meta name="WS_DICOM_3" content="{{ env('WS_DICOM_3') }}">
    <meta name="WS_DICOM_4" content="{{ env('WS_DICOM_4') }}">
    <meta name="WS_DICOM_5" content="{{ env('WS_DICOM_5') }}">
    <meta name="WS_DICOM_USER" content="{{ env('WS_DICOM_USER') }}">
    <meta name="WS_DICOM_PASS" content="{{ env('WS_DICOM_PASS') }}">
	
    <title>{{env('APP_NAME')}}</title>	
	@show
  </head>

<body>

   <div id="app">

        @yield('content')

    </div>
	
	<!-- Scripts Principal -->
    <script src="{{ mix('/js/app.js') }}"></script>

</body>
</html>
