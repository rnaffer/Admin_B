<!DOCTYPE html>
<html lang="es" xmlns="http://www.w3.org/1999/xhtml" >
<head>
 	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>OficinaVirtual - BoxMedia</title>
  <!-- ESTILO-->
  <link rel='stylesheet' type='text/css' href="{{ asset('assets/css/animate.min.css') }}">
 	<link rel='stylesheet' type='text/css' href="{{ asset('assets/css/style.css') }}">
	<link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Roboto:400,100,400italic,700italic,700'>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-alpha1/jquery.min.js"></script>

</head>

<body>
  <div class='form animated flipInX' >
    <h2><img src="{{ asset('assets/images/logo.png') }}" width="133" height="105"  alt=""/></h2>
    <h2>Bienvenido a Su Oficina Virtual</h2>

    <div id="wrapper">
      <div id="content-login">
        	@yield('content')
      </div>
    </div>
  </div>
</body>
</html>
