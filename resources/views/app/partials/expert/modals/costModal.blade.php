<form id="newCost" name="newCost" class="newCost">  
<input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
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
            @if($errors->has('detail'))
              <li>
                  <strong>
                      <span class="errorMessage">
                            {{ $errors->first('detail') }}
                      </span>
                  </strong>
              </li>
            @endif
            <li>
              <input id"detailTest" type="text" name="detail" value="{{ $modalCost->detail }}" placeholder="Concepto del costo">  
            </li>
            @if($errors->has('group'))
              <li>
                  <strong>
                      <span class="errorMessage">
                            {{ $errors->first('group') }}
                      </span>
                  </strong>
              </li>
            @endif
            <li>
              <div class="modalSelect">
                <select id="listGroup" name="listGroup">
                  @if(is_null($modalCost->group))
                    <option disabled selected hidden>Escoger Grupo..</option>
                  @else
                    <option selected hidden>{{ $modalCost->group }}</option>
                  @endif
                  @foreach($optionsGroup as $optionGroup)
                    <option>{{ $optionGroup }}</option>
                  @endforeach
                </select>
              </div>
            </li>
            @if($errors->has('subGroup'))
              <li>
                  <strong>
                      <span class="errorMessage">
                            {{ $errors->first('subGroup') }}
                      </span>
                  </strong>
              </li>
            @endif
            <li>
            <div class="modalSelect">
                <select id="listSubGroup" name="listSubGroup">
                  @include('app.partials.expert.modals.subGroupsCost')
                </select>
              </div>
            </li>
            @if($errors->has('unitaryCost'))
              <li>
                  <strong>
                      <span class="errorMessage">
                            {{ $errors->first('unitaryCost') }}
                      </span>
                  </strong>
              </li>
            @endif
            <li>
              <input type="text" name="unitaryCost" value="{{ $modalCost->unitaryCost }}" placeholder="Costo unitario actual">
            </li>
            @if($errors->has('quantity0'))
              <li>
                  <strong>
                      <span class="errorMessage">
                            {{ $errors->first('quantity0') }}
                      </span>
                  </strong>
              </li>
            @endif
            <li>
              <input type="text" name="quantity0" value="{{ $modalCost->quantity0 }}" placeholder="Valor año 0">
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
                          @php $quantity = 'quantity'.$i @endphp
                            <input class="miniCardInput"type="text" placeholder="0" value="{{ $modalCost->$quantity }}" name="quantity{{ $i }}">
                        </div>
                        @if($errors->has($quantity))
                          <div class="col-xl-12">
                              <strong>
                                  <span class="errorMessage">
                                        {{ $errors->first($quantity) }}
                                  </span>
                              </strong>
                          </div>
                        @endif
                      </div>
                      <div class="col-xl-2"></div>
                  </div>
                </div>
            @endfor
        </div>

        <div class="col-xl-12 modalFooter">
            <label id="SaveCostLabel" for="CloseCostModal" onclick="saveCost()" class="buttonSave">Guardar</label>
            <label for="CloseCostModal" class="buttonClose">Cerrar</label>
        </div>

      </div>
  </div>
  <div class="col-xl-4"></div>
  </form>
  <script type="text/javascript" src="{{ asset('js/app/systemApp.js') }}"></script>