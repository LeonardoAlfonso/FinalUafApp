@extends('web.templates.webTemplate')

@section('links')
    <link rel="stylesheet" href="{{ asset('css/web/zone.css') }}">
    <script type="text/javascript">
        var routeElements = '{{ route('zoneElements', ['id' => 'parameter']) }}';
        var routeSocioeconomicCharacteristics = '{{ route('zoneCharacteristics', ['id' => 'parameter']) }}';
    </script>
    <script type="text/javascript" src="{{ asset('js/web/zones.js') }}"></script>
@stop

@section('navigatorBar')
      @include('web.partials.zone.crumbs')
@stop

@section('viewContent')

<img id="backImage" src="{{ asset('images/web/BackImage1.jpg') }}" alt="">
<div id="content">/


<div id="description" class="col-xl-9">
  @if($option === 0)
      @include('web.partials.zone.characteristicsZone')
  @elseif($option === 1)
      @include('web.partials.zone.socioEconomicStudy')
  @endif

</div>

<aside id="Menu" class="col-xl-3">

  <div class="col-xl-2"></div>
  <ul class="col-xl-7 buttonlist">
    <li id="{{ $zone->idZone }}" class="col-xl-12" onclick="zoneElements(this.id)">
        <label for="" class="col-xl-12">Elementos Climáticos</label>
    </li>
    <li id="{{ $zone->idZone }}" class="col-xl-12" onclick="SocioeconomicCharacteristics(this.id)">
        <label for="" class="col-xl-12">Caracts. Socioeconómicas</label>
    </li>
    <li class="col-xl-12">
        <a href="{{ route('listSystem', ['idZone' => $zone->idZone]) }}">
          <label for="" class="col-xl-12">Sistemas Productivos</label>
        </a>
    </li>
    <li class="col-xl-12">
      <a href="{{ route('prevDepartament', ['name' => $departamentName]) }}">
          <label for="" class="col-xl-12">Regresar a Departameto</label>
      </a>
    </li>
  </ul>
  <div class="col-xl-3"></div>

</aside>
</div>
@stop
