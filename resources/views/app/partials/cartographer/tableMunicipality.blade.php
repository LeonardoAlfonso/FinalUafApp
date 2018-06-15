<table class="miniTable">
  <tbody>
    @if($municipalities->count() > 0)
      @foreach($municipalities as $municipality)
        <tr>
          <td id="{{ $municipality->idMunicipality }}" onclick="showVillages(this.id)">{{ $municipality->nameMunicipality }}</td>
          <td id="{{ $municipality->idMunicipality }}" onclick="deleteMunicipality(this.id)" style="width:10%"><a href="#"><img src="{{ asset('images/app/deleteIcon.png' )}}"></a></td>
        </tr>
      @endforeach
    @endif
  </tbody>
</table>
