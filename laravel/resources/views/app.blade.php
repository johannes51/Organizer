<!DOCTYPE html>
<html lang="de">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" value="{{ csrf_token() }}">

  <title>Webapplikation</title>

  <!-- Fonts -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
  <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

  <!-- Styles -->
  <link href=/css/app.css rel=preload as=style>
  <link href=/css/chunk-vendors.css rel=preload as=style>
  <link href=/js/app.js rel=preload as=script>
  <link href=/js/chunk-vendors.js rel=preload as=script>
  <link href=/css/chunk-vendors.css rel=stylesheet>
  <link href=/css/app.css rel=stylesheet>

</head>

<body id="app-layout">
  <div id="app"></div>

  <script src=/js/chunk-vendors.js></script> 
  <script src=/js/app.js></script>
  @if (isset(Route::getCurrentRoute()->parameters['route']))
  <script>
  window.serverRoute = '/{{ Route::getCurrentRoute()->parameters['route'] }}';
  </script>
  @endif
</body>

</html>