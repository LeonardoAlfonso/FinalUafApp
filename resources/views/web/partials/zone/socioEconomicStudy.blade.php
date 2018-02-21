<div class="col-xl-1"></div>
<article class="col-xl-11">
  <b><h2 id="ZoneId" name="{{ $zone->idZone }}">{{ $zone->nameZone }}</h2></b>
  <div class="col-xl-12">
    <h4><b>Características Socioecononómicas</b></h4>
  </div>
  <div class="col-xl-12">

      <table class="tableStyle"> <!-- Ciclo de la tabla -->
        <thead>
          <tr>
            <th><b>CARACTERÍSTICAS</b></th>
            <th>VALOR</th>
          </tr>
        </thead>
        <tbody>
          @foreach($indicators as $indicator)
          <tr>
            <td>{{ $indicator->nameIndicator }}</td>
            <td>{{ $indicator->valueIndicator }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>

  </div>
</article>
<div class="col-xl-0"></div>
