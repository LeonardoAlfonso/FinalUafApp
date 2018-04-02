<select id="nameMunicipality">
    <option disabled selected hidden>Escoger Municipio...</option> 
    @foreach($listMunicipalities as $municipality)
        <option>{{ $municipality->nameMunicipality }}</option>
    @endforeach
</select>
