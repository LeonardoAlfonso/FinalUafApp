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

    <link rel="stylesheet" href="css/ColumnsStyle.css">
    <link rel="stylesheet" href="css/app/systemConfiguration.css">

    @yield('links')
</head>

<body>

  <div class="container">

    <aside id="sideBar" class="col-xl-2">
        <figure class="col-xl-12">
          <img src="images/app/LogoAnt.png" alt="">
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
                    <li><img src="images/app/userIcon.png"></li>
                    <li id="UserName" ><h1> Nombre Usuario </h1></li>
                    <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                            <img id="closeSesion" src="images/app/LogOut.png">
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                  </ul>
                </div>
                <div class="col-xl-1">
            </div>
          </div>

          <div id="wrapperLogOut">
              <label for="" id="logOut">Logout</label>
          </div>


          <!-- <div class="col-xl-12">
            <div class="col-xl-6"></div>
            <div class="col-xl-6">
              <div class="col-xl-12">

                  <div class="col-xl-8"></div>
                  <div class="col-xl-3">
                    <ul id="LogOutSection">
                      <li><img src="images/app/userIcon.png"></li>
                      <li id="UserName" ><h1> Nombre Usuario </h1></li>
                      <li><img id="closeSesion" src="images/app/LogOut.png"></li>
                    </ul>
                  </div>
                  <div class="col-xl-1"></div>

              </div>
            </div>
          </div> -->



          <!-- <div class="col-xl-10"></div>
          <ul id="LogOutSection" class="col-xl-2">
            <li><img src="images/app/userIcon.png"></li>
            <li id="UserName" ><h1> Nombre Usuario </h1></li>
            <li><img src="images/app/LogOut.png"></li>
          </ul> -->
        </header>

        <div class="row">
          <img id="backImage" src="images/app/background.jpg" alt="">
          <article class="col-xl-12">
              @yield('form')
          </article>
        </div>

      <div class="row">
        <footer class="col-xl-12">
              <img src="images/app/LogoJaveriana.png">
        </footer>
      </div>

    </section>

  </div>

</body>
</html>
