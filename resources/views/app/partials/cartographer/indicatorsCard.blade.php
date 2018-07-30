<div class="col-xl-2"></div>
<div class="col-xl-4">
    <ul>
        @foreach($indicators as $indicator)
            <li class="items">
                <label>{{ $indicator->show }}</label>
            </li>
        @endforeach
    </ul>
</div>
<div class="col-xl-1"></div>
<div class="col-xl-3">
    <ul>
        @foreach($indicators as $indicator)
        <li class="items">
        @if($indicator->show == 'IVPR')
        <div class="socieconomics">
            <input type="text" id="{{ $indicator->show }}" name="{{ $indicator->show }}" value="{{ $indicator->value }}" readonly= "readonly">
                @if($errors->has($indicator->show))
                    <div class="col-xl-12">
                        <strong>
                            <span class="errorMessage">
                                {{ $errors->first($indicator->show) }}
                            </span>
                        </strong>
                    </div>
                @endif
        </div>
        @else
        <div class="socieconomics">
            <input type="text" id="{{ $indicator->show }}" name="{{ $indicator->show }}" value="{{ $indicator->value }}">
                @if($errors->has($indicator->show))
        
                    <div class="col-xl-12">
                        <strong>
                            <span class="errorMessage">
                                {{ $errors->first($indicator->show) }}
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