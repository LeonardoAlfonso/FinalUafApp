<input id="ShowModal" class="inputModal" name="modal" type="radio">
<label for="ShowModal"><img src="{{ asset('images/web/IconCharacteristic.png') }}"></label>
<div id="modal" class="col-xl-12">

    <div class="col-xl-4"></div>
    <div class="col-xl-4 card">
        <div class="titleCard col-xl-12">
            <p>Características Platano</p>
            <input id="CloseModal" class="inputModal" name="modal" type="radio">
            <label for="CloseModal"><img src="{{ asset('images/web/closeIcon.png') }}" alt=""></label>
        </div>
        <div class="titleBody col-xl-12">
          <div class="col-xl-2"></div>
          <div class="col-xl-8">
            <ul>
              @foreach($characteristics as $characteristic)
                <li>
                  <label>Z{{ $characteristic->nameCharacteristic }}</label>
                  <input type="text" name="" value="Hola">
                </li>
              @endforeach
            </ul>
          </div>
          <div class="col-xl-2"></div>
        </div>
    </div>
    <div class="col-xl-4"></div>
</div>
