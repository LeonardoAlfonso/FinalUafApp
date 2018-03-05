<form class="formRegister" action="{{ route('saveSystem') }}" method="post" enctype="multipart/form-data">
  {{ csrf_field() }}
<div class="col-xl-12">
  <div class="col-xl-6">
      <div class="col-xl-12">

        <div class="col-xl-1"></div>
        <div class="col-xl-9">
            <h2>Nuevo Sistema Productivo</h2>
        </div>
        <div class="col-xl-2"></div>

      </div>
  </div>
  <div class="col-xl-6">
    <div id="systemActions" class="col-xl-12">

        <div class="col-xl-3"></div>
        <div class="col-xl-6">
          <div id="calculate">
              <label id="calculateIndicators" class="standardButton">Calcular Indicadores</label>
          </div>
        </div>
        <div class="col-xl-2">
          <button type="submit" class="saveInput">
              Guardar
          </button>
        </div>
        <div class="col-xl-1"></div>

    </div>
  </div>
</div>

  <hr/>

<div class="col-xl-12">
  <div class="col-xl-10">
      <div class="col-xl-12">
          <div class="col-xl-6">
            <div class="col-xl-12">
              <div class="col-xl-1"></div>
              <div id="generalData" class="col-xl-11">
                <div class="col-xl-12">
                    <div class="systemContent col-xl-4">
                        <label for="">Nombre</label>
                    </div>
                    <div class="systemInput col-xl-8">
                        <input type="text" name="nameSystem" value="">
                    </div>
                </div>
              </div>
            </div>
            <div class="col-xl-12">
              <div class="col-xl-1"></div>
              <div id="generalData" class="col-xl-11">
                <div class="col-xl-12">
                    <div class="systemContent col-xl-4">
                        <label for="">Autor</label>
                    </div>
                    <div class="systemInput col-xl-8">
                        <input type="text" name="authorSystem" value="">
                    </div>
                </div>
              </div>
            </div>
            <div class="col-xl-12">
              <div class="col-xl-1"></div>
              <div id="generalData" class="col-xl-11">
                <div class="col-xl-12">
                    <div class="systemContent col-xl-4">
                        <label for="">Valor Jornal</label>
                    </div>
                    <div class="systemInput col-xl-8">
                        <input type="text" name="jornalSystem" value="">
                    </div>
                </div>
              </div>
            </div>
        </div>
          </form>
        <div class="col-xl-6">
          <div class="col-xl-12">
            <div class="col-xl-2"></div>
            <div class=" recomendationCard col-xl-9">
                <label for="">Recomendaciones:</label>
            </div>
            <div class="col-xl-1"></div>
          </div>
      </div>

      </div>

      <div class="col-xl-12">
        <div class="col-xl-1"></div>
        <div class="col-xl-3 TitleTable">
            <label class="nameComponents"for="">Costos Sistema</label>
        </div>
        <div class="col-xl-4"></div>
        <div class="col-xl-3 ButtonTable">
            <input id="ShowCostModal" class="inputModal" name="costModal" type="radio">
            <label for="ShowCostModal" class="systemComponents">Nuevo Costo</label>
            @include('app.partials.expert.modals.costModal')
        <div class="col-xl-1"></div>
        </div>
      </div>

      <div class="col-xl-12">
        <table class="tableStyle">
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
            <tr>
              <td>Sistema X</td>
              <td>Pepito Perez</td>
              <td>19-18-42</td>
              <td><a href="#"><img src="{{ asset('images/app/editIcon.png') }}"></a></td>
              <td><a href="#"><img src="{{ asset('images/app/deleteIcon.png') }}"></a></td>
            </tr>
          </tbody>
        </table>
      </div>

      <div class="col-xl-12">
        <div class="col-xl-1"></div>
        <div class="col-xl-3 TitleTable">
            <label class="nameComponents"for="">Ingresos Sistema</label>
        </div>
        <div class="col-xl-4"></div>
        <div class="col-xl-3 ButtonTable">
            <label class="systemComponents">Nuevo Ingreso</label>
        <div class="col-xl-1"></div>
        </div>
      </div>

      <div class="col-xl-12">
        <table class="tableStyle">
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
            <tr>
              <td>Sistema X</td>
              <td>Pepito Perez</td>
              <td>19-18-42</td>
              <td><a href="#"><img src="{{ asset('images/app/editIcon.png') }}"></a></td>
              <td><a href="#"><img src="{{ asset('images/app/deleteIcon.png') }}"></a></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

  <div class="col-xl-2">

    <div class="col-xl-12">
      <div class="col-xl-9 card">
          <div class="titleCard col-xl-12">
              <p>FIUS</p>
          </div>
          <div class="titleBody col-xl-12">
            <div class="col-xl-2"></div>
            <div class="col-xl-8">
              <ul>
                <li>
                  <label>53.6</label>
                </li>
              </ul>
            </div>
          </div>
      </div>
      <div class="col-xl-3"></div>
    </div>

    <div class="col-xl-12">
      <div class="col-xl-9 card">
          <div class="titleCard col-xl-12">
              <p>FIUS</p>
          </div>
          <div class="titleBody col-xl-12">
            <div class="col-xl-2"></div>
            <div class="col-xl-8">
              <ul>
                <li>
                  <label>53.6</label>
                </li>
              </ul>
            </div>
          </div>
      </div>
      <div class="col-xl-3"></div>
    </div>

    <div class="col-xl-12">
      <div class="col-xl-9 card">
          <div class="titleCard col-xl-12">
              <p>FIUS</p>
          </div>
          <div class="titleBody col-xl-12">
            <div class="col-xl-2"></div>
            <div class="col-xl-8">
              <ul>
                <li>
                  <label>53.6</label>
                </li>
              </ul>
            </div>
          </div>
      </div>
      <div class="col-xl-3"></div>
    </div>

    <div class="col-xl-12">
      <div class="col-xl-9 card">
          <div class="titleCard col-xl-12">
              <p>FIUS</p>
          </div>
          <div class="titleBody col-xl-12">
            <div class="col-xl-2"></div>
            <div class="col-xl-8">
              <ul>
                <li>
                  <label>53.6</label>
                </li>
              </ul>
            </div>
          </div>
      </div>
      <div class="col-xl-3"></div>
    </div>

    <div class="col-xl-12">
      <div class="col-xl-9 card">
          <div class="titleCard col-xl-12">
              <p>FIUS</p>
          </div>
          <div class="titleBody col-xl-12">
            <div class="col-xl-2"></div>
            <div class="col-xl-8">
              <ul>
                <li>
                  <label>53.6</label>
                </li>
              </ul>
            </div>
          </div>
      </div>
      <div class="col-xl-3"></div>
    </div>

    <div class="col-xl-12">
      <div class="col-xl-9 card">
          <div class="titleCard col-xl-12">
              <p>FIUS</p>
          </div>
          <div class="titleBody col-xl-12">
            <div class="col-xl-2"></div>
            <div class="col-xl-8">
              <ul>
                <li>
                  <label>53.6</label>
                </li>
              </ul>
            </div>
          </div>
      </div>
      <div class="col-xl-3"></div>
    </div>

</div>
</div>

<div class="col-xl-12">
  <div class="col-xl-12">

  </div>
</div>
