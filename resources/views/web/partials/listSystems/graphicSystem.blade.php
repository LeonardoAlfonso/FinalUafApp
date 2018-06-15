<div class="col-xl-1"></div>

<article id="graphSystem" class="col-xl-11">
  <div class="col-xl-12">
    <b><h2 id="{{ $first->idSystem }}">Sistema Productivo {{ $first->nameSystem }}</h2></b>
    <div id="piechart_3d"></div>
  </div>

  <div class="col-xl-12">
    <a href="{{ route('system', ['idSystem' => $first->idSystem]) }}"><label id="system">Ir al Sistema</label></a>
  </div>

</article>
<div class="col-xl-0"></div>
