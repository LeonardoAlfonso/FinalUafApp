<div class="col-xl-12">
  <div class="col-xl-6">
    <div class="col-xl-12">

      <div class="col-xl-1"></div>
      <div class="col-xl-5">
          <h2>Usuarios</h2>
      </div>
      <div class="col-xl-6"></div>

    </div>
  </div>
  <div class="col-xl-6">
    <div class="col-xl-12">
        <div class="col-xl-8"></div>
        <div class="col-xl-3">
          <div id="options">
            <a href="{{ route('getUser', ['id' => 'null']) }}"><label id="addUser" class="standardButton">Añadir Usuario</label></a>
          </div>
        </div>
        <div class="col-xl-1"></div>
    </div>
  </div>
</div>

<hr/>

@include('app.partials.admin.adminMessages')

<div id="Searcher" class="col-xl-12">
  <div class="col-xl-6">
    <div class="col-xl-12">
      <div class="col-xl-1"></div>
      <div class="col-xl-6">
          <img id= "IconSearcWord" onclick="searchWord()" src="{{ asset('images/app/searchIcon.png') }}" alt="">
          <input id ="InputSearchWord"type="text" name="" value="">
      </div>
      <div class="col-xl-5"></div>
    </div>
  </div>
  <div class="col-xl-6"></div>
</div>

<div id="ListUsersTable" class="col-xl-12">
  @include('app.partials.admin.tableUsers')
</div>