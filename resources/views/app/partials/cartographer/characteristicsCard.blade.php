<div class="col-xl-2"></div>
<div class="col-xl-4">
    <ul>
        @foreach($characteristics as $characteristic)
            <li class="items">
                <label>{{ $characteristic->show }}</label>
            </li>
        @endforeach
    </ul>
</div>
<div class="col-xl-1"></div>
<div class="col-xl-3">
    <ul>
        @foreach($characteristics as $characteristic)
        <li class="items">
            @if($characteristic->name == 'ZonaClimatica')
                <div class="ClimaticSelectStyle">
                <select id="climaticOptions" name="{{ $characteristic->name }}">
                    @if(empty($characteristic->value))
                        <option disabled selected hidden>Escoger Categoría...</option>
                    @else
                        <option selected hidden>{{ $characteristic->value }}</option>
                    @endif
                    
                    @foreach($climaticOptions as $climaticOption)
                        <option>{{ $climaticOption }}</option>
                    @endforeach
                </select>
                </div>
                @if($errors->has($characteristic->name))
                <div class="col-xl-12">
                    <strong>
                        <span class="errorMessage">
                            {{ $errors->first($characteristic->name) }}
                        </span>
                    </strong>
                </div>
            @endif
        @else
        <div class="climatics">
            <input type="text" name="{{ $characteristic->name }}" value="{{ $characteristic->value}}">
            @if($errors->has($characteristic->name))
                <div class="col-xl-12">
                    <strong>
                        <span class="errorMessage">
                            {{ $errors->first($characteristic->name) }}
                        </span>
                    </strong>
                </div>
            @endif
        </div>
        @endif
        </li>
        @endforeach
    </ul>
</div>
<div class="col-xl-2"></div>