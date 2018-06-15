  <div class="col-xl-12">
    <h4><b>Indicadores UAF</b></h4>
  </div>

  <div class="col-xl-8">
    <table class="tableStyle">
      <thead>
        <tr>
          <th>Indicador</th>
          <th>Valor</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @if($system->Indicators->count() > 0)
          @foreach($system->Indicators as $Indicator)
            <tr>
              <td>{{ $Indicator->nameIndicator }}</td>
              <td>{{ $Indicator->valueIndicator }}</td>
            </tr>
          @endforeach
        @endif
      </tbody>
    </table>
  </div>

  <div class="col-xl-4">

    <div class="col-xl-1"></div>
    <div class="col-xl-11">b
      <p><b>UAF mínima:</b> Corresponde al área requerida para generar una utilidad correspondiente a 2.5 SMLMV mensualmente bajo condiciones optimas de producción.</p>
      <p><b>UAF máxima:</b> Hace referencia al resultado del cálculo de la UAF, bajo un escenario de disminución en los precios  </p>
      <p><b>FIUS:</b> Corresponde a un factor incremental por uso sostenible, que busca garantizar en la UAF áreas de conservación, de acuerdo a las condiciones de cada ZRH</p>
      <p><b>Área para vivienda rural y huerta:</b> Corresponde a un área estándar de 2000m2, cuyo objetivo es garantizar un espacio para el establecimiento de la vivienda familiar y la huerta de pancoger. </p>
      <p><b>UAF mínima integral:</b> Corresponde total resultante de la suma de la UAF mínima, el FIUS y el área para vivienda rural y huerta.</p>
      <p><b>UAF máxima integral:</b> Es el resultado de la suma de la UAF máxima, el FIUS y el área para vivienda rural y huerta.</p>
    </div>
  </div>
