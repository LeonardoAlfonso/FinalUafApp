<table class="miniTable">
  <tbody>
    @foreach($municipalities as $municipality)
      <tr>
        <td >{{ $municipality->nameMunicipality }}</td>
        <td id="{{ $municipality->idMunicipality }}" onclick="deleteMunicipality(this.id)" style="width:10%"><a href="#"><img src="{{ asset('images/app/deleteIcon.png' )}}"></a></td>
      </tr>
    @endforeach
  </tbody>
</table>
