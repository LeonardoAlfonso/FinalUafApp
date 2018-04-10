<form id="newEntry" name="newEntry" class="newEntry" >
    <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
    <input type="hidden" name="idEntry" value="{{ $modalEntry->id }}">
    <div class="col-xl-4"></div>
    <div class="col-xl-4 modalCard">
        <div class="modalCardtitle col-xl-12">
            <p>Nuevo Ingreso</p>
        </div>

        <div class="col-xl-12">
          <hr id="ModalHr"/>
        </div>

        <div class="modalCardBody col-xl-12">
          <div class="col-xl-6">
            <ul>
              <li>
                <label>Concepto</label>
              </li>
              <li>
                <label>Unidad Medida</label>
              </li>
              <li>
                <label>Fuente Precio</label>
              </li>
              <li>
                <label>Fecha Fuente</label>
              </li>
              <li>
                <label>Precio Unitario</label>
              </li>
            </ul>
          </div>
          <div class="col-xl-6">
            <ul>
              @if($errors->has('name'))
                <li>
                    <strong>
                        <span class="errorMessage">
                              {{ $errors->first('name') }}
                        </span>
                    </strong>
                </li>
              @endif
              <li>
                <input type="text" name="concept" value="{{ $modalEntry->name }}" placeholder="Nombre del Producto">
              </li>
              @if($errors->has('measureUnity'))
                <li>
                    <strong>
                        <span class="errorMessage">
                              {{ $errors->first('measureUnity') }}
                        </span>
                    </strong>
                </li>
              @endif
              <li>
                <input type="text" name="measureUnity" value="{{ $modalEntry->measureUnity }}" placeholder="KG, Lb, unidad..."> 
              </li>
              @if($errors->has('priceSource'))
                <li>
                    <strong>
                        <span class="errorMessage">
                              {{ $errors->first('priceSource') }}
                        </span>
                    </strong>
                </li>
              @endif
              <li>
                <input type="text" name="source" value="{{ $modalEntry->priceSource }}"> 
              </li>
              @if($errors->has('datePriceSource'))
                <li>
                    <strong>
                        <span class="errorMessage">
                              {{ $errors->first('datePriceSource') }}
                        </span>
                    </strong>
                </li>
              @endif
              <li>
                <input type="text" name="sourceDate" value="{{ $modalEntry->datePriceSource }}">
              </li>
              @if($errors->has('unitaryPrice'))
                <li>
                    <strong>
                        <span class="errorMessage">
                              {{ $errors->first('unitaryPrice') }}
                        </span>
                    </strong>
                </li>
              @endif
              <li>
                <input type="text" name="unitaryPrice" value="{{ $modalEntry->unitaryPrice }}" placeholder="Precio Unitario">
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
                              <input class="miniCardInput"type="text" placeholder="0" value="{{ $modalEntry->$quantity }}" name="quantity{{ $i }}">
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
              <label for="CloseEntryModal" class="buttonSave" onclick="saveEntry()">Guardar</label>
              <label for="CloseEntryModal" class="buttonClose">Cerrar</label>
          </div>

        </div>
    </div>
    <div class="col-xl-4"></div>
</form>
@if($loadScript)
    <script type="text/javascript" src="{{ asset('js/app/costsEntries.js') }}"></script>
@endif