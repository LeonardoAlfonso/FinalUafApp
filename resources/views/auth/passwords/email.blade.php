@extends('layouts.app')

@section('content')
<div class="col-xl-12">

  <div class="col-xl-5"></div>
  <div class="col-xl-2 card">
      <div class="titleBody col-xl-12">
        <div class="col-xl-1"></div>
        <div class="col-xl-10">

          <form method="POST" action="{{ route('password.email') }}">
              @csrf

              <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                  <div class="col-xl-12">
                      <input id="email" type="email" name="email" placeholder="e-mail" class="inputs" value="{{ old('email') }}" required autofocus>

                      @if ($errors->has('email'))
                          <span class="invalid-feedback">
                              <strong>{{ $errors->first('email') }}</strong>
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
                </div>
              </div>
          </form>

        </div>
        <div class="col-xl-1"></div>
      </div>
  </div>
  <div class="col-xl-5"></div>
</div>
<!--


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-default">
                <div class="card-header">Reset Password</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row">

                            <div class="col-md-6">
                                <input id="email" type="email" class="inputs{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Send Password Reset Link
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> -->
@endsection
