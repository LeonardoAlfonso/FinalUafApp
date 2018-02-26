
<form class="formRegister" action="{{ route('saveUser') }}" method="post">
  {{ csrf_field() }}
  <div class="col-xl-12">
    <div class="col-xl-6">
      <div class="col-xl-12">

        <div class="col-xl-1">
                  <input type="hidden" name="idUser" value="{{ $user->idUser }}">
        </div>
        <div class="col-xl-5">
            @if($option === 'newUser')
              <h2>Nuevo Usuario</h2>
            @else
              <h2>Editar Usuario</h2>
            @endif
        </div>
        <div class="col-xl-6"></div>

      </div>
    </div>
    <div class="col-xl-6">
      <div class="col-xl-12">

        <div class="col-xl-8"></div>
        <div class="col-xl-3">
          <div id="options">

            <div id="labelWrapper">
              <button type="submit" class="saveInput">
                  Guardar
              </button>
            </div>

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
              <input type="text" class="generalData" name="firstName" value="{{ $user->firstName }}">
              @if($errors->has('firstName'))
                <strong>
                  <span class="error">
                        {{ $errors->first('firstName') }}
                  </span>
                </strong>
              @endif
          </div>
        </div>

        <div class="col-xl-12">
          <div class="col-xl-4">
              <label class="generalLabels">Apellidos</label>
          </div>
          <div class="col-xl-8">
              <input type="text" class="generalData" name="lastName" value="{{ $user->lastName }}">
              @if($errors->has('lastName'))
                <strong>
                  <span class="error">
                        {{ $errors->first('lastName') }}
                  </span>
                </strong>
              @endif
          </div>
        </div>

        <div class="col-xl-12">
          <div class="col-xl-4">
              <label class="generalLabels">e-mail</label>
          </div>
          <div class="col-xl-8">
              <input type="text" class="generalData" name="email" value="{{ $user->email }}">
              @if($errors->has('email'))
                <strong>
                  <span class="error">
                        {{ $errors->first('email') }}
                  </span>
                </strong>
              @endif
          </div>
        </div>

        @if($option === 'newUser')
          <div class="col-xl-12">
            <div class="col-xl-4">
                <label class="generalLabels">Contraseña</label>
            </div>
            <div class="col-xl-8">
                <input type="password" class="generalData" name="password" value="">
                @if($errors->has('password'))
                  <strong>
                    <span class="error">
                          {{ $errors->first('password') }}
                    </span>
                  </strong>
                @endif
            </div>
          </div>

          <div class="col-xl-12">
            <div class="col-xl-4">
                <label class="generalLabels">Confirmar Constraseña</label>
            </div>
            <div class="col-xl-8">
                <input type="password" class="generalData" name="confirmPassword" value="">
                @if($errors->has('confirmPassword'))
                  <strong>
                    <span class="error">
                          {{ $errors->first('confirmPassword') }}
                    </span>
                  </strong>
                @endif
            </div>
          </div>
        @endif

        <div class="col-xl-12">
          <div class="col-xl-4">
              <label class="generalLabels">Rol</label>
          </div>
          <div class="col-xl-8">

              <div class="select-style">
                <select id="optionsRoles" class="select" name="role">
                    <option disabled selected hidden>Escoger Rol...</option>
                    @foreach($roles as $role)
                        <option>{{ $role }}</option>
                    @endforeach
                </select>
                @if($errors->has('role'))
                  <strong>
                    <span class="error">
                          {{ $errors->first('role') }}
                    </span>
                  </strong>
                @endif
              </div>

          </div>
        </div>

        <div class="col-xl-12">
            <hr/>
        </div>

        <div class="col-xl-12 chooseLabels">
            <label class="generalLabels">Departamentos autorizados:</label>
        </div>


            @foreach($departaments as $groupDepartaments)
              <ul class="col-xl-12">
                  @foreach($groupDepartaments as $departament)
                    <li class="col-xl-4 departament">
                      @if($departament->check)
                          <input id="Departament{{ $departament->idDepartament }}" type="checkbox" name="Departament{{ $departament->idDepartament }}" value="{{ $departament->idDepartament }}" class="departament" checked>
                      @else
                          <input id="Departament{{ $departament->idDepartament }}" type="checkbox" name="Departament{{ $departament->idDepartament }}" value="{{ $departament->idDepartament }}" class="departament">
                      @endif
                      <label for="Departament{{ $departament->idDepartament }}" class="">{{ $departament->departamentName }}</label>
                    </li>
                  @endforeach
              </ul>
            @endforeach

      </div>

      <div class="col-xl-2"></div>
  </div>
</form>
