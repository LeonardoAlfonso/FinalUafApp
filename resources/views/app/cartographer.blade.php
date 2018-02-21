@extends('app.templates.appTemplate')
    <link rel="stylesheet" href="css/app/cartographer.css">
@section('links')

@stop

@section('menuOptions')
    <ul class="col-xl-12">
      <li class="optionsMenu">Departamentos
        <ul id="SubMenu">
          <li class="subMenuItem">Amazonas</li>
          <li class="subMenuItem">Casanare</li>
        </ul>
      </li>
    </ul>
@stop

@section('form')
    @include('app.partials.cartographer.newMunicipality')
@stop
