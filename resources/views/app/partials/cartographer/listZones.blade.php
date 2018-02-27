<div class="col-xl-12">
  <div class="col-xl-6">
      <div class="col-xl-12">

        <div class="col-xl-1"></div>
        <div class="col-xl-7">
            <h2>ZRH</h2>
        </div>
        <div class="col-xl-4"></div>

      </div>
  </div>
  <div class="col-xl-6">
    <div class="col-xl-12">
        <div class="col-xl-8"></div>
        <div class="col-xl-3">
          <div id="options">
            <a href="{{ route('getZone', ['idZone' => 'null', 'idDepartament' =>  $departament->idDepartament ]) }}">
                <label id="newZone" class="standardButton">Nueva Zona</label>
            </a>
          </div>
        </div>
        <div class="col-xl-1"></div>
    </div>
  </div>
</div>

  <hr/>

  <div class="col-xl-12">
    <div class="col-xl-6"></div>
    <div class="col-xl-6">
      <div class="col-xl-12">
          <div class="col-xl-6"></div>
          <div class="col-xl-5">
            <div id="map">
                <label id="addMap" class="standardButton">Añadir Mapa Departamento</label>
            </div>
          </div>
          <div class="col-xl-1"></div>
      </div>
    </div>
  </div>

  <div class="col-xl-12">
    <div class="col-xl-12">
      <table class="tableStyle"> <!-- Ciclo de la tabla -->
        <thead>
          <tr>
            <th>Nombre Zona</th>
            <th>Autor</th>
            <th>Publicación</th>
            <th></th>
            <th></th>
          </tr>
        </thead>
        <tbody>
           @foreach($zones as $zone)
            <tr>
              <td>{{ $zone->nameZone }}</td>
              <td>{{ $zone->autor }}</td>
              <td>{{ $zone->created_at }}</td>
              <td><a href="#"><img src="{{ asset('images/app/editIcon.png') }}"></a></td>
              <td><a href="#"><img src="{{ asset('images/app/deleteIcon.png') }}"></a></td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
