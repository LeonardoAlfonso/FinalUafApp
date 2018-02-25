<form class="formRegister" action="{{ route('') }}" method="post">
  <div class="col-xl-12">
    <div class="col-xl-6">
      <div class="col-xl-12">

        <div class="col-xl-1"></div>
        <div class="col-xl-5">
            <h2>Nuevo Usuario</h2>
        </div>
        <div class="col-xl-6"></div>

      </div>
    </div>
    <div class="col-xl-6">
      <div class="col-xl-12">

        <div class="col-xl-8"></div>
        <div class="col-xl-3">
          <div id="options">
            <a href="{{ route('adminis') }}"><label id="saveUser" class="standardButton">Guardar</label></a>
          </div>
        </div>
        <div class="col-xl-1"></div>

      </div>
    </div>
  </div>

    <hr/>

  <div class="col-xl-12">
      <div class="col-xl-2"></div>
      <div class="col-xl-8">

        <div class="col-xl-12">
          <div class="col-xl-4 topMargin">
              <label class="generalLabels">Nombres</label>
          </div>
          <div class="col-xl-8 topMargin">
              <input type="text" class="generalData" name="" value="">
          </div>
        </div>

        <div class="col-xl-12">
          <div class="col-xl-4">
              <label class="generalLabels">Apellidos</label>
          </div>
          <div class="col-xl-8">
              <input type="text" class="generalData" name="" value="">
          </div>
        </div>

        <div class="col-xl-12">
          <div class="col-xl-4">
              <label class="generalLabels">e-mail</label>
          </div>
          <div class="col-xl-8">
              <input type="text" class="generalData" name="" value="">
          </div>
        </div>

        <div class="col-xl-12">
          <div class="col-xl-4">
              <label class="generalLabels">Contraseña</label>
          </div>
          <div class="col-xl-8">
              <input type="text" class="generalData" name="" value="">
          </div>
        </div>

        <div class="col-xl-12">
          <div class="col-xl-4">
              <label class="generalLabels">Confirmar Constraseña</label>
          </div>
          <div class="col-xl-8">
              <input type="text" class="generalData" name="" value="">
          </div>
        </div>

        <div class="col-xl-12">
          <div class="col-xl-4">
              <label class="generalLabels">Rol</label>
          </div>
          <div class="col-xl-8">
              <input type="text" class="generalData" name="" value="">
          </div>
        </div>

        <div class="col-xl-12">
            <hr/>
        </div>

        <div class="col-xl-12 chooseLabels">
            <label class="generalLabels">Departamentos autorizados:</label>
        </div>

        <div class="col-xl-12">
            <div class="col-xl-4">
              <ul>
                <li>
                  <input type="checkbox" name="" value="" class="departament">
                  <label class="departament">Amazonas</label>
                </li>
              </ul>
            </div>
            <div class="col-xl-4">
              <ul>
                <li>
                  <input type="checkbox" name="" value="" class="departament">
                  <label class="departament">Amazonas</label>
                </li>
              </ul>
            </div>
            <div class="col-xl-4">
              <ul>
                <li>
                  <input type="checkbox" name="" value="" class="departament">
                  <label class="departament">Amazonas</label>
                </li>
              </ul>
            </div>
        </div>

      </div>

      <div class="col-xl-2"></div>
  </div>
</form>
