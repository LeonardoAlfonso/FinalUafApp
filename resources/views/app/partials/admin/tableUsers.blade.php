
  <table class="tableStyle"> <!-- Ciclo de la tabla -->
    <thead>
      <tr>
        <th>Usuario</th>
        <th>e-mail</th>
        <th>Rol</th>
        <th>Fecha de Creación</th>
        <th></th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      @foreach($users as $user)
      <tr>
        <td>{{ $user->firstName }} {{ $user->lastName }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->role }}</td>
        <td>{{ $user->created_at }}</td>
        <td>
          <a href="{{ route('getUser', ['id' => $user->idUser ]) }}">
            <img src="{{ asset('images/app/editIcon.png') }}">
          </a>
        </td>
        <td id="deleteUserJS">
          <a href="{{ route('userDelete', ['id' => $user->idUser ]) }}">
            <img onclick="deleteUserConfirm()" src="{{ asset('images/app/deleteIcon.png') }}">
          </a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  <div id="WrapperPaginator"class="col-xl-12">
        {{ $users->links('app.templates.paginator') }}
  </div>


