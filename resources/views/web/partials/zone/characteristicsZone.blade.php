<div class="col-xl-1"></div>
<article class="col-xl-11">
  <b><h2 id="ZoneId" name="{{ $zone->idZone }}">{{ $zone->nameZone }}</h2></b> <!-- Variable Nombre Zona/ Id de la zona -->
  <div class="col-xl-5">
    <figure id="miniMap">

      <img src="{{ asset('storage/miniMaps/'.$zone->nameZone.'.png') }}" alt="{{ asset('storage/miniMaps/'.$zone->nameZone.'.jpeg') }}">
    </figure>
  </div>
  <div class="col-xl-7">

    <div class="col-xl-1"></div>
    <div class="col-xl-11">
      <table class="tableStyle"> <!-- Ciclo de la tabla -->
        <thead>
          <tr>
            <th><b>ELEMENTOS CLIMÁTICOS</b></th>
            <th>VALOR</th>
          </tr>
        </thead>
        <tbody>
          @foreach($characteristics as $characteristic)
            <tr>
              <td>{{ $characteristic->nameCharacteristic }}</td>
              <td>{{ $characteristic->valueCharacteristic }}</td>
            </tr>
          @endforeach
            <tr>
              <td>Municipios</td>
              <td>{{ $municipalities }}</td>
            </tr>
        </tbody>
      </table>
    </div>
  </div>
</article>
<div class="col-xl-0"></div>
