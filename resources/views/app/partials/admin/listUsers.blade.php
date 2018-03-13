<div class="col-xl-12">
  <div class="col-xl-6">
    <div class="col-xl-12">

      <div class="col-xl-1"></div>
      <div class="col-xl-5">
          <h2>Usuarios</h2>
      </div>
      <div class="col-xl-6"></div>

    </div>
  </div>
  <div class="col-xl-6">
    <div class="col-xl-12">
        <div class="col-xl-8"></div>
        <div class="col-xl-3">
          <div id="options">
            <a href="{{ route('getUser', ['id' => 'null']) }}"><label id="addUser" class="standardButton">Añadir Usuario</label></a>
          </div>
        </div>
        <div class="col-xl-1"></div>
    </div>
  </div>
</div>

<hr/>

<div id="Searcher" class="col-xl-12">
  <div class="col-xl-6">
    <div class="col-xl-12">
      <div class="col-xl-1"></div>
      <div class="col-xl-6">
          <img src="images/app/searchIcon.png" alt="">
          <input type="text" name="" value="">
      </div>
      <div class="col-xl-5"></div>
    </div>
  </div>
  <div class="col-xl-6"></div>
</div>

<div class="col-xl-12">
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
            <img src="{{ asset('images/app/deleteIcon.png') }}">
          </a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  <div class="col-xl-12">
        {{ $users->links('app.templates.paginator') }}
  </div>

</div>
