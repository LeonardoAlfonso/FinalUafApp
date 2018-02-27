@extends('app.templates.appTemplate')
    <link rel="stylesheet" href="{{ asset('css/app/cartographer.css') }}">
@section('links')

@stop

@section('menuOptions')
    <ul class="col-xl-12">
      <li class="optionsMenu">Departamentos
        <ul id="SubMenu">
          @foreach($departaments as $departament)
            <a href="{{ route('listZones',['idDepartament' => $departament->idDepartament]) }}">
              <li class="subMenuItem">{{ $departament->departamentName }}</li>
            </a>
          @endforeach
        </ul>
      </li>
    </ul>
@stop

@section('form')
  @if($option === 'listZones')
      @include('app.partials.cartographer.listZones')
  @elseif($option === 'configZone')
      @include('app.partials.cartographer.configZone')
  @else

  @endif
@stop
