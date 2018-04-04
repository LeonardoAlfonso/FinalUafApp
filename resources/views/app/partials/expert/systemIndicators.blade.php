@foreach($indicators as $indicator)
  <div class="col-xl-12">
    <div class="col-xl-9 card">
        <div class="titleCard col-xl-12">
            <p>{{ $indicator->showIndicator }}</p>
        </div>
        <div class="titleBody col-xl-12">
          <div class="col-xl-2"></div>
          <div class="col-xl-8">
            <ul>
              <li>
                <label>{{ $indicator->valueIndicator }}</label>
              </li>
            </ul>
          </div>
        </div>
    </div>
    <div class="col-xl-3"></div>
  </div>
@endforeach