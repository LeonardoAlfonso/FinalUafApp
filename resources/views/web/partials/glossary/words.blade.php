  @foreach($words as $word)
    <li id="{{ $word->idWord }}" onclick="searchDefinitions(this.id)"><b>{{ $word->word }}</b></li>
  @endforeach
