<form class="formRegister" action="{{ route('saveZone') }}" method="post" enctype="multipart/form-data">
  {{ csrf_field() }}
<div class="col-xl-12">
  <div class="col-xl-6">
      <div class="col-xl-12">

        <div class="col-xl-1"></div>
        <div class="col-xl-7">
            <h2>Nueva Zona</h2>
            <input type="hidden" name="tokenZone" value="{{ $token }}">
            <input type="hidden" name="idDepartament" value="{{ $idDepartament }}">
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
              <label id="addMap" for="fileControl" class="zoneButtons">Añadir Mapa Zona</label>
                @if($errors->has('miniMapFile'))
                  <div class="col-xl-12">
                      <strong>
                          <span class="errorImage">
                                {{ $errors->first('miniMapFile') }}
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
              <div class="col-xl-2"></div>
              <div class="col-xl-8">
                <ul>
                  @foreach($characteristics as $characteristic)
                    <li>
                      <label>{{ $characteristic->showCharacteristic }}</label>
                      @if($characteristic->nameCharacteristic == 'ZonaClimatica')
                          <div class="ClimaticSelectStyle">
                            <select id="climaticOptions" name="{{ $characteristic->nameCharacteristic }}">
                                <option disabled selected hidden>Escoger Categoría...</option>
                                <option>DC</option>
                                <option>D</option>
                                <option>E</option>
                                <option>R</option>
                            </select>
                          </div>
                          @if($errors->has($characteristic->nameCharacteristic))
                          <div class="col-xl-12">
                              <strong>
                                  <span class="errorMessage">
                                        {{ $errors->first($characteristic->nameCharacteristic) }}
                                  </span>
                              </strong>
                          </div>
                        @endif
                      @else
                        <input type="text" name="{{ $characteristic->nameCharacteristic }}" value="{{ $characteristic->valueCharacteristic}}">
                        @if($errors->has($characteristic->nameCharacteristic))
                          <div class="col-xl-12">
                              <strong>
                                  <span class="errorMessage">
                                        {{ $errors->first($characteristic->nameCharacteristic) }}
                                  </span>
                              </strong>
                          </div>
                        @endif
                      @endif
                    </li>
                  @endforeach
                </ul>
              </div>
              <div class="col-xl-2"></div>
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
              <div class="col-xl-2"></div>
              <div class="col-xl-12">

                <div class="col-xl-0"></div>
                <div class="col-xl-11">
                  <ul>
                    @foreach($indicators as $indicator)
                      <li>
                        <label style="padding-left:20%">{{ $indicator->showIndicator }}</label>
                          @if($indicator->showIndicator == 'IVPR')
                            <input type="text" id="{{ $indicator->showIndicator }}" name="{{ $indicator->showIndicator }}" value="{{ $indicator->valueIndicator }}" readonly= "readonly">
                              @if($errors->has($indicator->showIndicator))
                                <div class="col-xl-12">
                                    <strong>
                                        <span class="errorMessage">
                                              {{ $errors->first($indicator->showIndicator) }}
                                        </span>
                                    </strong>
                                </div>
                              @endif
                          @else
                            <input type="text" id="{{ $indicator->showIndicator }}" name="{{ $indicator->showIndicator }}" value="{{ $indicator->valueIndicator }}">
                            @if($errors->has($indicator->showIndicator))
                                <div class="col-xl-12">
                                    <strong>
                                        <span class="errorMessage">
                                              {{ $errors->first($indicator->showIndicator) }}
                                        </span>
                                    </strong>
                                </div>
                              @endif
                          @endif
                      </li>
                    @endforeach
                  </ul>
                </div>
                <div class="col-xl-1"></div>

              </div>
            </div>

            <div class="col-xl-12">
              <div class="col-xl-1"></div>
              <div class="col-xl-10 cardFooter">
                @foreach($indicators as $indicator)
                  <p>* {{ $indicator->nameIndicator }}</p>
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
