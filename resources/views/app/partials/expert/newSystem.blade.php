<form id="formNewSystem" class="formRegister" action="{{ route('saveSystem') }}" method="post" enctype="multipart/form-data">
  {{ csrf_field() }}
  <input type="hidden" name="idZone" value="{{ $zone->idZone }}">
  <input type="hidden" name="idSystem" value="{{ $system->idSystem }}">
<div class="col-xl-12">
  <div class="col-xl-6">
      <div class="col-xl-12">

        <div class="col-xl-1"></div>
        <div class="col-xl-9">
            <h2>Nuevo Sistema Productivo - {{ $zone->nameZone }}</h2>
        </div>
        <div class="col-xl-2"></div>

      </div>
  </div>
  <div class="col-xl-6">
    <div id="systemActions" class="col-xl-12">

        <div class="col-xl-3"></div>
        <div class="col-xl-6">
          <div id="calculate">
              <label id="calculateIndicators" class="standardButton" onclick="calculateIndicators()">Calcular Indicadores</label>
          </div>
        </div>
        <div class="col-xl-2">
          <button id="SaveSystemButton" type="button" class="saveInput" onclick="saveSystem()">Guardar</button>
          <button type="submit" id="SubmmitSystemButton"></button>
        </div>
        <div class="col-xl-1"></div>

    </div>
  </div>
</div>

  <hr/>

<div class="col-xl-12">
  <div class="col-xl-10">
      <div class="col-xl-12">
          <div class="col-xl-6" id="SystemMainData">    
            @include('app.partials.expert.generalDataSystem')
          </div>
          </form>
        <div class="col-xl-6">
          <div class="col-xl-12">
            <div class="col-xl-2"></div>
            <div id="recomendationCard" class="recomendationCard col-xl-9">
                @include('app.partials.expert.recomendationsCard')
            </div>
            <div class="col-xl-1"></div>
          </div>
      </div>

      </div>

      <div class="col-xl-12">
        <div class="col-xl-1"></div>
        <div class="col-xl-3 TitleTable">
            <label class="nameComponents"for="">Costos Sistema</label>
        </div>
        <div class="col-xl-4"></div>
        <div id="costForm" class="col-xl-3 ButtonTable">
            <input id="ShowCostModal" class="inputModal" name="costModal" type="radio">
            <label for="ShowCostModal" class="systemComponents">Nuevo Costo</label>
            <input id="CloseCostModal" class="inputModal" name="costModal" type="radio">  

            <div id="costModal" class="col-xl-12 systemModal">        
                    @include('app.partials.expert.modals.costModal')  
            </div>

              
        </div>
        <div class="col-xl-1"></div>
      </div>

      <div class="col-xl-12">
        <table class="tableStyle">
          <thead>
            <tr>
              <th>Detalle</th>
              <th>Grupo</th>
              <th>Subgrupo</th>
              <th>C. Unitario</th>
              <th>Año 0</th>
              <th>Año 1</th>
              <th>Año 2</th>
              <th>Año 3</th>
              <th>Año 4</th>
              <th>Año 5</th>
              <th>Año 6</th>
              <th>Año 7</th>
              <th>Año 8</th>
              <th>Año 9</th>
              <th>Año 10</th>
              <th>Año 11</th>
              <th>Año 12</th>
              <th></th>
              <th></th>
            </tr>
          </thead>
          <tbody id="BodyCostTable">
            @include('app.partials.expert.tableCosts')
          </tbody>
        </table>
      </div>


      <div class="col-xl-12">
        <div class="col-xl-1"></div>
        <div class="col-xl-3 TitleTable">
            <label class="nameComponents"for="">Ingresos Sistema</label>
        </div>
        <div class="col-xl-4"></div>
        <div class="col-xl-3 ButtonTable">
            <input id="ShowEntryModal" class="inputModal" name="entryModal" type="radio">
            <label for="ShowEntryModal" class="systemComponents">Nuevo Ingreso</label>
            <input id="CloseEntryModal" class="inputModal" name="entryModal" type="radio">

            <div id="entryModal" class="col-xl-12 systemModal">
                @include('app.partials.expert.modals.entryModal')
            </div>
        </div>
        <div class="col-xl-1"></div>
      </div>

        <div class="col-xl-12">
          <table class="tableStyle">
            <thead>
              <tr>
                <th>Concepto</th>
                <th>Unidad Medida</th>
                <th>Fuente Precio</th>
                <th>Fecha Fuente</th>
                <th>Precio Unitario</th>
                <th>Año 1</th>
                <th>Año 2</th>
                <th>Año 3</th>
                <th>Año 4</th>
                <th>Año 5</th>
                <th>Año 6</th>
                <th>Año 7</th>
                <th>Año 8</th>
                <th>Año 9</th>
                <th>Año 10</th>
                <th>Año 11</th>
                <th>Año 12</th>
                <th></th>
                <th></th>
              </tr>
            </thead>
            <tbody id="BodyEntryTable">
              @include('app.partials.expert.tableEntries')
            </tbody>
          </table>
        </div>

    </div>
    <div id="systemIndicators" class="col-xl-2">
      @include('app.partials.expert.systemIndicators')
    </div>
</div>

<div class="col-xl-12">
  <div class="col-xl-12">

  </div>
</div>
