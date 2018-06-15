@extends('web.templates.webTemplate')

@section('links')
    <link rel="stylesheet" href="css/web/aboutUs.css">
@stop

@section('viewContent')
  <img id="backImage" src="{{ asset('images/web/BackImage1.jpg') }}" alt="">
<div id="content">

  <div id="description" class="col-xl-9">

    <div class="col-xl-1"></div>
      @if($options === 0)
          @include('web.partials.aboutUs.quienesSomos')
      @elseif($options === 1)
          @include('web.partials.aboutUs.UAF')
      @elseif($options === 2)
          @include('web.partials.aboutUs.UAFIntegral')
      @else
          @include('web.partials.aboutUs.unidadAgricolaFamiliar')
      @endif
    <div class="col-xl-1"></div>

  </div>

  <aside id="Menu" class="col-xl-3">

    <div class="col-xl-2"></div>
    <ul class="col-xl-7 buttonlist">
      <!-- <li class="col-xl-12"><label for="" class="col-xl-12">Quienes Somos</label></li> -->
      <li class="col-xl-12">
          <a href="{{ route('aboutUs') }}"><label for="" class="col-xl-12">Quienes Somos</label></a>
      </li>
      <li class="col-xl-12">
        <a href="{{ route('Unity') }}"><label for="" class="col-xl-12">Unidad Agrícola Familiar</label></a>
      </li>
      <li class="col-xl-12">
        <a href="{{ route('UAF') }}"><label for="" class="col-xl-12">UAF Máxima y Mínima</label></a>
      </li>
      <li class="col-xl-12">
        <a href="{{ route('IntegralUAF') }}"><label for="" class="col-xl-12">UAF Integral</label></a>
      </li>
    </ul>
    <div class="col-xl-3"></div>

  </aside>
</div>

@stop
