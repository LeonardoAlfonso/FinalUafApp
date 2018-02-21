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
            <a href="{{ route('newUser') }}"><label id="addUser" class="standardButton">Añadir Usuario</label></a>
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
      <tr>
        <td>Pepito Perez</td>
        <td>pepito@pepito.com</td>
        <td>Admin</td>
        <td>19-18-52</td>
        <td><img src="images/app/editIcon.png"></td>
        <td><img src="images/app/deleteIcon.png"></td>
      </tr>
    </tbody>
  </table>
</div>
