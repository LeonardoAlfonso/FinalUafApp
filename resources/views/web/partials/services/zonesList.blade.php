<option disabled selected hidden>Escoger Zona..</option>
@foreach($zones as $zone)
  <option id='{{ $zone->idZone }}'>{{ $zone->nameZone }}</option>
@endforeach
