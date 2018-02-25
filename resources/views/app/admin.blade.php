@extends('app.templates.appTemplate')
    <link rel="stylesheet" href="css/app/users.css">
@section('links')

@stop

@section('menuOptions')
    <ul class="col-xl-12">
      <a href="{{ route('admin') }}"><li id="users" class="optionsMenu">Usuarios</li></a>
      <a href="{{ route('editIndicators') }}"><li id="indicators" class="optionsMenu">Indicadores</li></a>
    </ul>
@stop

@section('form')
      @include('app.partials.admin.listUsers')
@stop
