<form class="formRegister" action="{{ route('saveZone') }}" method="post">
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

            <div id="labelWrapper">
              <button type="submit" class="saveInput">
                  Guardar
              </button>
            </div>

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
        </div>
        <div class="col-xl-1"></div>

      </div>
    </div>
    <div class="col-xl-6">
      <div class="col-xl-12">

          <div class="col-xl-3"></div>
          <div class="col-xl-4">
            <div id="municipality">
                <label id="addMunicipality" class="standardButton">Añadir Municipio</label>
            </div>
          </div>
          <div class="col-xl-4">
            <div id="map">
                <label id="addMap" class="standardButton">Añadir Mapa Zona</label>
            </div>
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
                      <label>{{ $characteristic->nameCharacteristic}}</label>
                      <input type="text" name="{{ $characteristic->showCharacteristic }}" value="{{ $characteristic->valueCharacteristic}}">
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
                        <label>{{ $indicator->nameIndicator }}</label>
                        <input type="text" name="{{ $indicator->showIndicator }}" value="{{ $indicator->valueIndicator }}">
                      </li>
                    @endforeach
                  </ul>
                </div>
                <div class="col-xl-1"></div>

              </div>
            </div>
        </div>
        <div class="col-xl-1"></div>

      </div>
    </div>

  </div>
  </form>
