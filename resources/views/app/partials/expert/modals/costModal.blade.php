<input id="CloseCostModal" class="inputModal" name="costModal" type="radio">
<div id="costModal" class="col-xl-12">
  <form id="newCost">
    <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
    <input type="hidden" name="tokenSystem" value="{{ $tokenSystem }}">
    <div class="col-xl-4"></div>
    <div class="col-xl-4 modalCard">
        <div class="modalCardtitle col-xl-12">
            <p>Nuevo Costo</p>
        </div>

        <div class="col-xl-12">
          <hr id="ModalHr"/>
        </div>

        <div class="modalCardBody col-xl-12">
          <div class="col-xl-6">
            <ul>
              <li>
                <label>Detalle</label>
              </li>
              <li>
                <label>Grupo Costo</label>
              </li>
              <li>
                <label>Subgrupo Costo</label>
              </li>
              <li>
                <label>Costo Unitario</label>
              </li>
              <li>
                <label>Cantidad para establecimiento</label>
              </li>
            </ul>
          </div>

          <div class="col-xl-6">
            <ul>
              <li>
                <input type="text" name="detail" value="">
              </li>
              <li>
                <input type="text" name="group" value="">
              </li>
              <li>
                <input type="text" name="subGroup" value="">
              </li>
              <li>
                <input type="text" name="unitaryCost" value="">
              </li>
              <li>
                <input type="text" name="quantity0" value="">
              </li>
            </ul>
          </div>

          <div class="col-xl-12">
            <hr id="ModalHrIntern"/>
          </div>

          <div class="modalCardSubtitle col-xl-12">
              <b><p>Cantidades por año</p></b>
          </div>

          <div class="col-xl-12">


            @for($i = 1; $i <= 12; $i++)
                  <div class="col-xl-4">
                    <div class="col-xl-12 miniCard">
                        <div class="col-xl-2"></div>
                        <div class="col-xl-8">

                          <div class="col-xl-12 miniCardTitle">
                              Año {{ $i }}
                          </div>
                          <div class="col-xl-12 miniCardBody">
                              <input class="miniCardInput"type="text" name="quantity{{ $i }}" value="5">
                          </div>
                        </div>
                        <div class="col-xl-2"></div>
                    </div>
                  </div>
              @endfor


          </div>

          <div class="col-xl-12 modalFooter">
              <label for="CloseCostModal" class="buttonSave" onclick="saveCost()">Guardar</label>
              <label for="CloseCostModal" class="buttonClose">Cerrar</label>
          </div>

        </div>
    </div>
    <div class="col-xl-4"></div>
</form>
</div>
