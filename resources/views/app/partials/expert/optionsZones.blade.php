<option disabled selected hidden>Escoger zona..</option>
@if(is_null($selectZone->idZone))
        <option disabled selected hidden>Escoger zona..</option>
    @else
        <option selected hidden>{{ $selectZone->nameZone }}</option>
        <input type="hidden" id="idZone" value"{{ $selectZone->idZone }}">
@endif
@foreach($zones as $zone)
  <option name="Zone">{{ $zone->nameZone }}</option>
@endforeach
