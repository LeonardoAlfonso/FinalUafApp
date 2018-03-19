<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Pontificia Universidad Javeriana de Cali">
    <meta name="description" content="">
    <meta name="keywords" content="">

    <title>ANT Administración</title>
    <link href="https://fonts.googleapis.com/css?family=Lato|Nunito" rel="stylesheet" type='text/css'>

    <link rel="stylesheet" href="{{ asset('css/ColumnsStyle.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app/systemConfiguration.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    @yield('links')
</head>

<body>
  <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
  <div class="container">

    <aside id="sideBar" class="col-xl-2">
        <figure class="col-xl-12">
          <img src="{{ asset('images/app/LogoAnt.png') }}" alt="">
        </figure>

        @yield('menuOptions')

    </aside>

    <section id="content" class="col-xl-10">

        <header class="row">

          <div class="col-xl-12">
            <div class="col-xl-6"></div>
            <div class="col-xl-6">
                <div class="col-xl-8"></div>
                <div class="col-xl-3">
                  <ul id="LogOutSection">

                    <li><img src="{{ asset('images/app/userIcon.png') }}"></li>
                    <li id="UserName" ><h1> Nombre Usuario </h1></li>
                    <li>
                      <div id="closeSesion">
                          <img src="{{ asset('images/app/LogOut.png') }}">

                          <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                                  <div id="wrapperLogOut">
                              <label for="" id="logOut">Logout</label>
                              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                  @csrf
                              </form>
                              </div>
                           </a>

                      </div>
                    </li>

                  </ul>
                </div>
                <div class="col-xl-1">
            </div>
          </div>

        </header>

        <div class="row">
          <img id="backImage" src="{{ asset('images/app/background.jpg') }}" alt="">
          <article class="col-xl-12">
              @yield('form')
          </article>
        </div>

      <div class="row">
        <footer class="col-xl-12">
              <img src="{{ asset('images/app/LogoJaveriana.png') }}">
        </footer>
      </div>

    </section>

  </div>

</body>
</html>
