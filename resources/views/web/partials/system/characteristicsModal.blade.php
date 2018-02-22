@if($product->Characteristics->count() > 0)
  <label id="{{ $product->idEntry }}" for="ShowModal" onclick="getCharacteristics(this.id)">
    <img src="{{ asset('images/web/IconCharacteristic.png') }}">
  </label>
  <input id="ShowModal" class="inputModal" name="modal" type="radio">

  <div id="modal" class="col-xl-12">

      <div class="col-xl-4"></div>
      <div class="col-xl-4 card">
          <div class="titleCard col-xl-12">
              <p>Características {{ $product->name }}</p>
              <input id="CloseModal" class="inputModal" name="modal" type="radio">
              <label for="CloseModal"><img src="{{ asset('images/web/closeIcon.png') }}" alt=""></label>
          </div>
          <div id="ModalBody" class="titleBody col-xl-12">

          </div>
      </div>
      <div class="col-xl-4"></div>

  </div>
  @endisset
