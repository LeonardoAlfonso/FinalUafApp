@if($option === 0)
  <option disabled selected hidden>Escoger departamento..</option>
@else
  <option selected>{{ $prevDepartament }}</option>
@endif
@foreach($departaments as $departament)
  <option>{{ $departament->departamentName }}</option>
@endforeach
