<div class="col-xl-2"></div>
<div class="col-xl-8">
  <ul>
    <li>
        @foreach($entries->Characteristics as $entry)
          <label>{{ $entry->nameCharacteristic }}</label>
          <input type="text" disabled name="" value="{{ $entry->valueCharacteristic }}">
        @endforeach()
    </li>
  </ul>
</div>
<div class="col-xl-2"></div>
