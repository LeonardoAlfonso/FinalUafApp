<div class="col-xl-12">
  <div class="col-xl-6">
      <div class="col-xl-12">

        <div class="col-xl-1"></div>
        <div class="col-xl-7">
            <h2>Municipios</h2>
        </div>
        <div class="col-xl-4"></div>

      </div>
  </div>
  <div class="col-xl-6">
    <div class="col-xl-12">
        <div class="col-xl-8"></div>
        <div class="col-xl-3">
          <div id="options">
            <a href="{{ route('getZone', ['idZone' => $currentZone->idZone, 'idDepartament' => $currentDepartament->idDepartament, 'validations' => '' ]) }}">
              <label id="saveZone" class="standardButton">Volver</label>
            </a>
          </div>
        </div>
        <div class="col-xl-1"></div>
    </div>
  </div>
</div>

  <hr/>

  <div class="col-xl-12">
    <div class="col-xl-6">
      <div id="Municipalities" class="col-xl-12">

        <div class="col-xl-1"></div>
        <div class="col-xl-2">
            <h3>Municipio:</h3>
        </div>
        <div class="col-xl-4">
          <div id="ClimaticSelectStyle" class="ClimaticSelectStyle">
            @include('app.partials.cartographer.listMunicipalities')
          </div>
        </div>
        <div class="col-xl-4">
          <div id="newMunicipality">
              <label id="addMunicipality" class="standardButton" onclick="saveMunicipality()">Añadir Municipio</label>
          </div>
        </div>
        <div class="col-xl-1"></div>

      </div>
    </div>
    <div class="col-xl-6">
        <div id="Villages" class="col-xl-12">

          <div class="col-xl-1"></div>
          <div class="col-xl-2">
              <!-- <h3>Vereda:</h3> -->
          </div>
          <div class="col-xl-4">
              <!-- <input class="names" type="text" name="" value=""> -->
          </div>
          <div class="col-xl-4">
            <!-- <div id="newVillage">
                <label id="addVillage" class="standardButton">Añadir Vereda</label>
            </div> -->
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
                <p>Municipios</p>
            </div>
            <div id="tableMunicipalities" class="titleBody col-xl-12">
                @include('app.partials.cartographer.tableMunicipality')
            </div>
        </div>
        <div class="col-xl-1"></div>

      </div>
    </div>
    <div class="col-xl-6">
      <div class="col-xl-12">

        <div class="col-xl-1"></div>
        <!-- <div class="col-xl-10 card">
            <div class="titleCard col-xl-12">
                <p>Veredas</p>
            </div>
            <div class="titleBody col-xl-12">
              <div class="col-xl-2"></div>
              <div id="Villages" class="col-xl-12">
              </div>
            </div>
        </div> -->
        <div class="col-xl-1"></div>

      </div>
    </div>

  </div>
