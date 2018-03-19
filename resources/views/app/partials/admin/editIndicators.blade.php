<form class="formRegister" action="{{ route('saveIndicators') }}" method="post">
  {{ csrf_field() }}
<div class="col-xl-12">
  <div class="col-xl-6">
    <div class="col-xl-12">

      <div class="col-xl-1"></div>
      <div class="col-xl-5">
          <h2>Indicadores</h2>
      </div>
      <div class="col-xl-6"></div>

    </div>
  </div>
  <div class="col-xl-6">
    <div class="col-xl-12">

      <div class="col-xl-8"></div>
      <div class="col-xl-3 ">

        <div id="options">
          <div id="labelWrapper">
            <button id="SaveIndicators" type="submit" class="saveInput">
                Guardar
            </button>
          </div>
        </div>

    </div>
  </div>
</div>
</div>

  <hr/>

<div class="col-xl-12">
    <div class="col-xl-2"></div>
    <div class="col-xl-8 topMargin">



      @foreach($parameters as $parameter)
        <div class="col-xl-12">
          <div class="col-xl-4">
              <label class="generalLabels">{{ $parameter->showParameter }}</label>
          </div>
          <div class="col-xl-8">
              @if($parameter->showParameter == 'Inflacion')
                <input type="text" class="generalData" name="{{ $parameter->idParameter }}" 
                        value="{{ $parameter->valueParameter }}" readonly= "readonly">
              @else
                <input type="text" class="generalData" name="{{ $parameter->idParameter }}" 
                          value="{{ $parameter->valueParameter }}">
              @endif
              @if($errors->has($parameter->idParameter))
                <strong>
                  <span class="error">
                        {{ $errors->first($parameter->idParameter) }}
                  </span>
                </strong>
              @endif
          </div>
        </div>
      @endforeach

    </div>

    <div class="col-xl-2"></div>
</div>
</form>
