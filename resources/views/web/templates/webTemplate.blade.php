<!DOCTYPE html>
<html lang="es">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Pontificia Universidad Javeriana de Cali">
    <meta name="description" content="">
    <meta name="keywords" content="">

    <title>Agencia nacional de tierras</title>
    <link href="https://fonts.googleapis.com/css?family=Lato|Nunito" rel="stylesheet" type='text/css'>



    <link rel="stylesheet" href="{{ asset('css/ColumnsStyle.css') }}">
    <link rel="stylesheet" href="{{ asset('css/web/TemplateWebStyle.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    @yield('links')
    <!--<link rel="stylesheet" href="css/web/aboutUs.css">
    <link rel="stylesheet" href="css/web/glossary.css">
    <link rel="stylesheet" href="css/web/Services.css">
    <link rel="stylesheet" href="css/web/Zone.css"> -->

</head>

<body>
  <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
  <div id="container">
    <header class="row">

      <!-- Logo -->
      <div class="col-xl-6 col-lg-4 col-md-4 col-n-3 col-sm-12 col-xs-12">

          <div class="col-xl-1 col-lg-1 col-md-1 col-n-1 col-sm-3 col-xs-2"></div>
          <div id="LogoAnt" class="col-xl-3 col-lg-6 col-md-7 col-n-10 col-sm-6 col-xs-8">
            <a href="{{ route('home') }}">
              <figure id="WrapperLogo">
                <img src="{{ asset('images/web/LogoAnt.png') }}">
              </figure>
            </a>
          </div>
          <div class="col-xl-8 col-lg-6 col-md-4 col-n-1 col-sm-3 col-xs-2"></div>

      </div>

      <!-- Menú -->
      <div class="col-xl-6 col-lg-8 col-md-8 col-n-9 col-sm-12 col-xs-12">

        <ul>
          <li class="col-xl-1 col-lg-1 col-md-0 col-n-0 col-sm-0 col-xs-0"></li>
          <li class="col-xl-2 col-lg-2 col-md-2 col-n-2 col-sm-2 col-xs-12"><a href="{{ route('home') }}" id="BotonInicio"><b>Inicio</b></a></li>
          <li class="col-xl-2 col-lg-2 col-md-2 col-n-2 col-sm-2 col-xs-12"><a href="{{ route('services') }}" id="BotonServicios"><b>Servicios</b></a></li>
          <li class="col-xl-2 col-lg-2 col-md-2 col-n-2 col-sm-2 col-xs-12"><a href="{{ route('glossary')}}" id="BotonGlosario"><b>Glosario</b></a></li>
          <li class="col-xl-3 col-lg-3 col-md-4 col-n-4 col-sm-4 col-xs-12"><a href="{{ route('aboutUs') }}" id="BotonQuienes"><b>Quienes Somos</b></a></li>
          <li class="col-xl-1 col-lg-2 col-md-2 col-n-2 col-sm-2 col-xs-12"><a href="{{ route('login') }}" id="BotonLogin"><b>Login</b></a></li>
          <li class="col-xl-1 col-lg-0 col-md-0 col-n-0 col-sm-0 col-xs-0"></li>
        </ul>

      </div>
    </header>
    <hr/>

    <section id="navigator" class="row">
      @yield('navigatorBar')
    </section>

    <section id="structure" class="row">
        @yield('viewContent')
    </section>
  </div>
    <footer class="row">
          Instituto de Estudios Interculturales - Pontifica Universidad Javeriana Cali © copyright 2018
    </footer>

</body>
</html>
