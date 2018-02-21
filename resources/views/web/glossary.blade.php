@extends('web.templates.webTemplate')

@section('links')
    <link rel="stylesheet" href="css/web/glossary.css">
    @include('web.scripts.glossaryJs')
@stop

@section('viewContent')
  <img id="backImage" src="images/web/BackImage1.jpg" alt="">

  <aside id="glossaryDescription" class="col-xl-3">
    <div class="col-xl-3"></div>
    <div class="col-xl-9">
      <h2><b>Glosario</b></h2>
      <p>
          Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna
          aliqua.
          Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
          Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
          Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
      </p>
    </div>
  </aside>

  <div id="glossaryContent" class="col-xl-9">

    <div class="col-xl-1"></div>
    <article class="col-xl-10">

      <div class="row">
        <div class="col-xl-12">
          <ul id="Letters">
            @foreach($letters as $letter)
              <li id="{{ $letter->group }}" onclick="searchWords(this.id)">{{ $letter->group }}</li>
            @endforeach
          </ul>
        </div>
      </div>

      <div class="row">
          <div class="col-xl-3">
            <ul id="Words">
              @include('web.partials.glossary.words')
            </ul>
          </div>
          <div class="col-xl-1"></div>
          <div id="definition" class="col-xl-8">
              @include('web.partials.glossary.definitions')
          </div>
      </div>

    </article>
    <div class="col-xl-1"></div>

  </div>
@stop
