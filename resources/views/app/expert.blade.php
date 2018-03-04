@extends('app.templates.appTemplate')

@section('links')
  <link rel="stylesheet" href="{{ asset('css/app/expert.css') }}">
  <link rel="stylesheet" href="{{ asset('css/app/modals.css') }}">
  <script type="text/javascript">
      var routeZonesList = '{{ route('zonesList', ['nameDepartament' => 'parameter']) }}';
  </script>
  <script type="text/javascript" src="{{ asset('js/app/systemApp.js') }}"></script>
@stop

  @section('menuOptions')
      <ul class="col-xl-12">
        <a href="{{ route('expert') }}"><li id="systems" class="optionsMenu">Sistemas Productivos</li></a>

        <li id="reports" class="optionsMenu">Reportes</li>
      </ul>
@stop

@section('form')
  @if($option === 'List')
    @include('app.partials.expert.listSystems')
  @elseif($option === 'configSystem')
    @include('app.partials.expert.newSystem')
  @else
    @include('app.partials.expert.newSystem')
  @endif

@stop
