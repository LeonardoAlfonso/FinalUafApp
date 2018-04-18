<div class="titleCard col-xl-12">
    <p>Recomendaciones</p>
</div>
<div class="bodyCard col-xl-12">
    <ul>
        @foreach($errors as $error)
            <li>
                <p class="error">ERROR!: </p><span>{{ $error }}</span> 
            </li>
        @endforeach
    </ul>

    <ul>
        @foreach($warnings as $warning)
            <li>
                <p class="warn">Advertencia: </p> {{ $warning }}
            </li>
        @endforeach
    </ul>
</div>