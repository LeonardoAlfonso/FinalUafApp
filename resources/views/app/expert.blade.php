@extends('app.templates.appTemplate')
    <link rel="stylesheet" href="css/app/expert.css">
    <link rel="stylesheet" href="css/app/modals.css">
@section('links')

@stop

@section('menuOptions')
    <ul class="col-xl-12">
      <li id="systems" class="optionsMenu">Sistemas Productivos</li>
      <li id="reports" class="optionsMenu">Reportes</li>
    </ul>
@stop

@section('form')
    @include('app.partials.expert.newSystem')
@stop
