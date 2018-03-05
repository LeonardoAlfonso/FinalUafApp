<option disabled selected hidden>Escoger zona..</option>
@foreach($zones as $zone)
  <option name="Zone">{{ $zone->nameZone }}</option>
@endforeach
