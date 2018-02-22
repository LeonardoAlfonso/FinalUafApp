@extends('web.templates.webTemplate')

@section('links')
    <link rel="stylesheet" href="{{ asset('css/web/system.css') }}">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="{{ asset('js/web/graphicProfile.js') }}"></script>
    <script type="text/javascript">
        var routeCharacteristics = '{{ route('entryCharacteristics', ['idEntry' => 'parameter']) }}';
    </script>
    <script type="text/javascript" src="{{ asset('js/web/system.js') }}"></script>
@stop

@section('navigatorBar')
    @include('web.partials.zone.crumbs')
@stop

@section('viewContent')
  <img id="backImage" src="{{ asset('images/web/BackImage1.jpg') }}" alt="">

  <div class="col-xl-12">
      <div class="col-xl-1"></div>
      <div id="SystemTitle" class="col-xl-11">
          <h2><b>Sistema Productivo {{ $system->nameSystem }}</b></h2>
      </div>
  </div>

  <div class="col-xl-12">
    <aside id="systemOptions" class="col-xl-3">
      <div class="col-xl-3"></div>
      <div id="AccordeonMenu" class="col-xl-9">

        <a href="{{ route('system', ['idSystem' => $system->idSystem]) }}">
          <label class="col-xl-12">Productos</label>
        </a>

        <label class="col-xl-12">Costos del sistema productivo</label>

        <input type="checkbox" id="graphics">
        <label for="graphics" class="col-xl-12">Indicadores Financieros</label>

        <ul id="economicGraphics" class="col-xl-12">
          <li>Gráfico 1</li>
          <li>Gráfico 1</li>
          <li>Gráfico 1</li>
          <li>Gráfico 1</li>
        </ul>

        <label class="col-xl-12">Tamaño UAF</label>
        <label class="col-xl-12">Ir a Sistemas Productivos</label>

      </div>
    </aside>

    <div id="systemContent" class="col-xl-9">

      <div class="col-xl-1"></div>
          @include('web.partials.system.products')

    </div>
  </div>

@stop
