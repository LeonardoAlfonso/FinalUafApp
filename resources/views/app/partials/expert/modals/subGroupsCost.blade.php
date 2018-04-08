@if(is_null($modalCost->subGroup))
    <option disabled selected hidden>Escoger SubGrupo..</option>
@else
    <option selected hidden>{{ $modalCost->subGroup }}</option>
@endif
@foreach($optionsSubGroup as $subgroup)
    <option>{{ $subgroup }}</option>
@endforeach