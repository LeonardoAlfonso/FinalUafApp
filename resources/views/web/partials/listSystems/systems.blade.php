<ul id="systemList" class="col-xl-12">
  @foreach($systems as $system)
    <li id="{{ $system->idSystem }}" class="col-xl-12" onclick="getSystem(this.id)">
      {{ $system->nameSystem }}
    </li>
  @endforeach
</ul>
