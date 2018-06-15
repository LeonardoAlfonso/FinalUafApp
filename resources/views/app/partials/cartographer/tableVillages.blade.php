<input type="hidden" id="idMunicipality" value="{{ $idMunicipality }}">
<table class="miniTable">
  <tbody>
    @foreach($villages as $village)
      <tr>
        <td>{{ $village->nameVillage }}</td>
        <td style="width:10%"><a href="#"><img id="{{ $village->nameVillage }}" onclick="deleteVillage(this.id)" 
                                            src="{{ asset('images/app/deleteIcon.png' )}}"></a></td>
      </tr>
    @endforeach
  </tbody>
</table>
<script type="text/javascript" src="{{ asset('js/app/municipality.js') }}"></script>