@extends('web.templates.webTemplate')

@section('links')
    <link rel="stylesheet" href="{{ asset('css/web/Home.css') }}">
@stop

@section('viewContent')
<div id="content">

  <aside id="SlideContainer"class="col-xl-12">
    <div class="slide">
        <img src="{{ asset('images/web/Slide1.jpg') }}" alt>
        <p><span class="signature">"La UAF es una figura que sirve para ordenar el territorio <br/> permitiendo el acceso a tierras en condiciones de dignidad y equidad social, <br/> 
        para los campesinos que no tienen o tienen muy poca tierra."</span></p>

    </div>
    <div id="Slide2" class="slide">
        <img src="{{ asset('images/web/Slide2.jpg') }}" alt>
        <p><span class="signature">"Los objetivos de la reforma agraria integral con enfoque territorial <br/> se encaminan al logro y realización de los derechos <br/> 
        de la población rural y su permanencia en el territorio."</span></p>
    </div>
    <div class="slide">
        <img src="{{ asset('images/web/Slide3.jpg') }}" alt>
        <p><span class="signature">"El campo es un escenario de inclusión <br/> 
        que reconoce la diversidad social, productiva y <br/> 
        ecológica del territorio"</span></p>
    </div>
    <div class="slide">
        <img src="{{ asset('images/web/Slide2.jpg') }}" alt>
        <p><span class="signature">"El ordenamiento social, productivo y ambiental del territorio contribuye <br/> a la creación de condiciones dignas para la redistribución equitativa de la tierra <br/> y el cierre de la brecha entre en el campo y la ciudad"</span></p>
    </div>
    <div class="slide">
        <img src="{{ asset('images/web/Slide1.jpg') }}" alt>
        <p><span class="signature">"La UAF es una figura que sirve para ordenar el territorio <br/> permitiendo el acceso a tierras en condiciones de dignidad y equidad social, <br/> 
        para los campesinos que no tienen o tienen muy poca tierra."</span></p>
    </div>
  </aside>

</div>

@stop
