<div class="col-xl-12">
  <div id="crumbWrapper">
      <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
    <ul class="crumbs">
      @foreach($elements as $key => $element)
        @if($key === 'Departament')
              <a href="{{ route('prevDepartament', ['name' => $element]) }}">
              <li class="crumbs" name="{{ $key }}">{{ $element }}</li>
            </a>
            <li> · </li>
        @endif
        @if($key === 'Zone')
            <a href="{{ route('prevZone', ['name' => $element]) }}">
              <li class="crumbs" name="{{ $key }}">{{ $element }}</li>
              </a>
            <li> · </li>
        @endif
        @if($key === 'ListSystem')
            <a href="{{ route('listSystem', ['idZone' => $element]) }}">
              <li class="crumbs" name="{{ $element }}">Listado Sistemas</li>
              </a>
            <li> · </li>
        @endif
        @if($key === 'System')
            <a href="{{ route('listSystem', ['idZone' => $element]) }}">
              <li class="crumbs" name="{{ $element }}">Listado Sistemas</li>
              </a>
            <li> · </li>
        @endif

      @endforeach
    </ul>
  </form>
</div>
