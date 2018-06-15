@extends('layouts.app')

@section('content')
<div class="col-xl-12">

  <div class="col-xl-5"></div>
  <div class="col-xl-2 card">
      <div class="titleBody col-xl-12">
        <div class="col-xl-1"></div>
        <div class="col-xl-10">

          <form class="form-horizontal" method="POST" action="{{ route('login') }}">
              {{ csrf_field() }}

              <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                  <div class="col-xl-12">
                      <input id="email" type="email" name="email" placeholder="e-mail" class="inputs" value="{{ old('email') }}" required autofocus>
                  </div>
              </div>

              <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">

                  <div class="col-xl-12">
                      <input id="password" type="password" name="password" placeholder="contraseña" required class="inputs">

                      @if ($errors->has('email'))
                          <span class="help-block">
                              <strong>{{ $errors->first('email') }}</strong>
                          </span>
                      @endif

                      @if ($errors->has('password'))
                          <span class="help-block">
                              <strong>{{ $errors->first('password') }}</strong>
                          </span>
                      @endif
                  </div>
              </div>

              <div class="form-group">
                  <div class="col-xl-12">
                    <div id="labelWrapper">
                      <button type="submit" class="loginInput">
                          Login
                      </button>
                    </div>


                      <br/>

                      <!-- <div id="Forgot">
                        <a  href="{{ route('password.request') }}">
                          Olvidaste tu contraseña?
                        </a>
                      </div> -->

                  </div>
              </div>
          </form>

        </div>
        <div class="col-xl-1"></div>
      </div>
  </div>
  <div class="col-xl-5"></div>
</div>
@endsection
