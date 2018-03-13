@extends('app.templates.appTemplate')

@section('links')
    <link rel="stylesheet" href="{{ asset('css/app/users.css') }}">
    <script type="text/javascript" src="{{ asset('js/app/administrator.js') }}"></script>
@stop

@section('menuOptions')
    <ul class="col-xl-12">
      <a href="{{ route('admin') }}"><li id="users" class="optionsMenu">Usuarios</li></a>
      <a href="{{ route('editIndicators') }}"><li id="indicators" class="optionsMenu">Indicadores</li></a>
    </ul>
@stop

@section('form')
  @if($option === 'listUser')
      @include('app.partials.admin.listUsers')
  @elseif($option === 'indicators')
      @include('app.partials.admin.editIndicators')
  @else
      @include('app.partials.admin.configUser')
  @endif
@stop
