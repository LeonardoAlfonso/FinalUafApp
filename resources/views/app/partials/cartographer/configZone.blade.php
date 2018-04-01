<form class="formRegister" action="{{ route('saveZone') }}" method="post" enctype="multipart/form-data">
  {{ csrf_field() }}
<div class="col-xl-12">
  <div class="col-xl-6">
      <div class="col-xl-12">

        <div class="col-xl-1"></div>
        <div class="col-xl-7">
          @if(empty($zone->nameZone))
            <h2>Nueva Zona - {{ $currentDepartament->departamentName }}</h2>
          @else
            <h2>{{ $zone->nameZone }} - {{ $currentDepartament->departamentName }}</h2>
          @endif
            
            <input type="hidden" id="fileState" name="fileState" value="{{ $zone->file_name }}">
            <input type="hidden" name="idDepartament" value="{{ $currentDepartament->idDepartament }}">
            <input type="hidden" name="idZone" value="{{ $zone->idZone }}">
        </div>
        <div class="col-xl-4"></div>

      </div>
  </div>
  <div class="col-xl-6">
    <div class="col-xl-12">
        <div class="col-xl-8"></div>
        <div class="col-xl-3">
          <div id="options">
              <label id="addZone" for="saveZone" class="zoneButtons">Guardar</label>
              <button id="saveZone" name="saveZone" type="submit"></button>            
          </div>
        </div>
        <div class="col-xl-1"></div>
    </div>
  </div>
</div>

  <hr/>

  <div class="col-xl-12">
    <div class="col-xl-6">
      <div id="nameMapZone" class="col-xl-12">

        <div class="col-xl-1"></div>
        <div class="col-xl-2">
            <h3>Nombre</h3>
        </div>
        <div class="col-xl-7">
            <input type="text" name="nameZone" value="{{ $zone->nameZone }}">
            @if($errors->has('nameZone'))
              <div class="col-xl-12">
                  <strong>
                      <span class="errorMessage">
                            {{ $errors->first('nameZone') }}
                      </span>
                  </strong>
              </div>
            @endif
        </div>
        <div class="col-xl-1"></div>

      </div>
    </div>
    <div class="col-xl-6">
      <div class="col-xl-12">

          <div class="col-xl-3"></div>
          <div class="col-xl-4 wrapperOptions">
              <label for="addMunicipality" class="zoneButtons">Añadir Municipio</label>
              <button id="addMunicipality" name="addMunicipality" type="submit"></button>
          </div>
          <div class="col-xl-4 wrapperOptions">
              @if(empty($zone->file_name))
                <label id="addMap" for="fileControl" class="zoneButtons">Añadir Mapa Zona</label>
              @else
                <label id="addMap" for="fileControl" class="zoneButtons">{{ $zone->file_name }}</label>
              @endif   
                @if($errors->has('miniMapFile'))
                  <div class="col-xl-12">
                      <strong>
                          <span class="errorImage">
                                {{ $errors->first('miniMapFile') }}
                          </span>
                      </strong>
                  </div>
                @endif
                @if($errors->has('fileState'))
                  <div class="col-xl-12">
                      <strong>
                          <span class="errorImage">
                                {{ $errors->first('fileState') }}
                          </span>
                      </strong>
                  </div>
                @endif
              <input type="file" id="fileControl" name="miniMapFile" value="">
          </div>
          <div class="col-xl-1"></div>

      </div>
    </div>
  </div>

  <div class="col-xl-12">
    <div class="col-xl-6">
      <div class="col-xl-12">

        <div class="col-xl-1"></div>
        <div class="col-xl-10 card">
            <div class="titleCard col-xl-12">
                <p>Elementos Climáticos</p>
            </div>
            <div class="titleBody col-xl-12">
              @include('app.partials.cartographer.characteristicsCard')
            </div>
        </div>
        <div class="col-xl-1"></div>

      </div>
    </div>
    <div class="col-xl-6">
      <div class="col-xl-12">

        <div class="col-xl-1"></div>
        <div class="col-xl-10 card">
            <div class="titleCard col-xl-12">
                <p>Características Socioeconómicas</p>
            </div>
            <div class="titleBody col-xl-12">
              @include('app.partials.cartographer.indicatorsCard')
            </div>

            <div class="col-xl-12">
              <div class="col-xl-1"></div>
              <div class="col-xl-10 cardFooter">
                @foreach($indicators as $indicator)
                  <p>* {{ $indicator->name }}</p>
                @endforeach
              </div>
              <div class="col-xl-1"></div>
            </div>
        </div>
        <div class="col-xl-1"></div>

      </div>
    </div>

  </div>
  </form>
