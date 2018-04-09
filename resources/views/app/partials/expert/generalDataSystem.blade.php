<div class="col-xl-12">
    <div class="col-xl-1"></div>
    <div id="generalData" class="col-xl-11">
    <div class="col-xl-12">
        <div class="systemContent col-xl-4">
            <label for="">Nombre</label>
        </div>
        <div class="systemInput col-xl-8">
            <input id="nameSystem" type="text" name="nameSystem" value="{{ $system->nameSystem }}">
            @if($errors->has('nameSystem'))
                <div class="col-xl-12">
                    <strong>
                        <span class="errorMessage">
                            {{ $errors->first('nameSystem') }}
                        </span>
                    </strong>
                </div>
            @endif
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
            <input id="authorSystem" type="text" name="authorSystem" value="{{ $system->autor }}">
            @if($errors->has('authorSystem'))
                <div class="col-xl-12">
                    <strong>
                        <span class="errorMessage">
                            {{ $errors->first('authorSystem') }}
                        </span>
                    </strong>
                </div>
            @endif
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
            <input id="jornalSystem" type="text" name="jornalSystem" value="{{ $system->jornalValue }}">
            @if($errors->has('jornalSystem'))
                <div class="col-xl-12">
                    <strong>
                        <span class="errorMessage">
                            {{ $errors->first('jornalSystem') }}
                        </span>
                    </strong>
                </div>
            @endif
        </div>
    </div>
    </div>
</div>