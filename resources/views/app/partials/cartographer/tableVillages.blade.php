<table class="miniTable">
  <tbody>
    @foreach($municipalities->Villages as $village)
      <tr>
        <td>{{ $village->nameVillage }}</td>
        <td style="width:10%"><a href="#"><img src="{{ asset('images/app/deleteIcon.png' )}}"></a></td>
      </tr>
    @endforeach
  </tbody>
</table>
