<div class="col-xl-12">
  <div class="col-xl-6">
      <div class="col-xl-12">

        <div class="col-xl-1"></div>
        <div class="col-xl-7">
            <h2>Sistemas productivos</h2>
        </div>
        <div class="col-xl-4"></div>

      </div>
  </div>
  <div class="col-xl-6">
    <div class="col-xl-12">
        <div class="col-xl-8"></div>
        <div class="col-xl-3">
        <div id="options">
            <a href="{{ route('getSystem', ['idZone' => $selectZone->idZone, 'idSystem' => '' ]) }}">
                <label id="newSystem" class="standardButton" onclick="detectZone({{ $selectZone->idZone }})">Nuevo Sistema</label>
            </a>
          </div>
        </div>
        <div class="col-xl-1"></div>
    </div>
  </div>
</div>

  <hr/>
  @include('app.partials.expert.expertMessages')

  <div class="col-xl-12">
    <div class="col-xl-6">
      <div id="Filters" class="col-xl-12">
        <form class="row" action="{{ route('systemList') }}" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
            <div class="col-xl-1"></div>
            <div class="col-xl-5">
              <div class="select-style-expert">
                <select id="optionsDepartament" name="Departament" class="select">
                    @if(empty($selectDepartament))
                            <option disabled selected hidden>Escoger departamento..</option>
                        @else
                            <option selected hidden>{{ $selectDepartament->departamentName }}</option>
                    @endif
                    @foreach($departaments as $departament)
                      <option name="Departament">{{ $departament->departamentName }}</option>
                    @endforeach
                </select>
              </div>
            </div>
            <div class="col-xl-1"></div>
            <div class="col-xl-5">
              <div class="select-style-expert">
                <select id="optionsZones" name="Zone" class="select" onchange="this.form.submit()">
                      @include('app.partials.expert.optionsZones')
                </select>
              </div>
            </div>
         </form>
      </div>
    </div>
    <div class="col-xl-6"></div>
  </div>
    @include('app.partials.expert.tableListSystems')
  <div class="col-xl-12">

  </div>
