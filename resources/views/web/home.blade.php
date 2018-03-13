@extends('web.templates.webTemplate')

@section('links')
    <link rel="stylesheet" href="{{ asset('css/web/Home.css') }}">
@stop

@section('viewContent')
<div id="content">

  <aside id="SlideContainer"class="col-xl-12">
    <div class="slide">
        <img src="images/web/Slide1.jpg" alt>
        <p><span class="signature">“Con la paz se abren todas las puertas para que la tierra <br/>
          comience a ser el principal motor de desarrollo en el país”</span><br/>
          <i>MIGUEL SAMPER, Director de la Agencia Nacional de Tierras</i></p>
    </div>
    <div id="Slide2" class="slide">
        <img src="images/web/Slide2.jpg" alt>
        <p><span class="signature">Trabajamos para que el uso agrario<br/>
          sea ambientalmente sostenible</span></p>
    </div>
    <div class="slide">
        <img src="images/web/Slide3.jpg" alt>
        <p>texto</p>
    </div>
    <div class="slide">
        <img src="images/web/Slide2.jpg" alt>
        <p>texto</p>
    </div>
    <div class="slide">
        <img src="images/web/Slide1.jpg" alt>
        <p><span class="signature">“Con la paz se abren todas las puertas para que la tierra <br/>
          comience a ser el principal motor de desarrollo en el país”</span><br/>
          <i>MIGUEL SAMPER, Director de la Agencia Nacional de Tierras</i></p>
    </div>
  </aside>

</div>

@stop
