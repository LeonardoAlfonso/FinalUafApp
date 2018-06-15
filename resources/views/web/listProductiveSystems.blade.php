@extends('web.templates.webTemplate')

@section('links')
    <link rel="stylesheet" href="{{ asset('css/web/listSystems.css') }}">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="{{ asset('js/web/graphicSystem.js') }}"></script>

    <script type="text/javascript">
        var routeSystems = '{{ route('changeSystem', ['idSystem' => 'parameter']) }}';
        var assetGraphics = '{{ asset('js/web/graphicSystem.js') }}';
    </script>
    <script type="text/javascript" src="{{ asset('js/web/system.js') }}"></script>
@stop

@section('navigatorBar')
    @include('web.partials.zone.crumbs')
@stop

@section('viewContent')
<img id="backImage" src="{{ asset('images/web/BackImage1.jpg') }}" alt="">
<div id="content">

<div id="description" class="col-xl-9">

    @include('web.partials.listSystems.graphicSystem')

</div>

<section id="MenuSystems" class="col-xl-3">

  <div class="col-xl-2"></div>

  <div id="AccordeonMenu" class="col-xl-7">

    <input type="checkbox" id="list">
    <label for="list" class="col-xl-12">Sistemas Productivos</label>

        @include('web.partials.listSystems.systems')
    <a href="{{ route('prevZone', ['name' => $nameZone]) }}">
        <label id="backZone" class="col-xl-12">Ir a la Zona</label>
    </a>

  </div>

  <div class="col-xl-3"></div>

</section>
</div>
@stop
