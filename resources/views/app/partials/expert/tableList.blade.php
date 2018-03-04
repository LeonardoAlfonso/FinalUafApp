<table class="tableStyle"> <!-- Ciclo de la tabla -->
  <thead>
    <tr>
      <th>Nombre Sistema</th>
      <th>Autor</th>
      <th>Publicación</th>
      <th></th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    @foreach($systems as $system)
      <tr>
        <td>{{ $system->nameSystem }}</td>
        <td>{{ $system->autor }}</td>
        <td>{{ $system->created_at }}</td>
        <td><a href="#"><img src="{{ asset('images/app/editIcon.png') }}"></a></td>
        <td><a href="#"><img src="{{ asset('images/app/deleteIcon.png') }}"></a></td>
      </tr>
    @endforeach
  </tbody>
</table>

protected $fillable = ['nameSystem','autor','jornalValue','idZone
