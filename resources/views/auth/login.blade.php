@extends('layouts.app')

@section('content')
  <div id="login-form" class="container">
    <div class="columns is-centered">
      <div class="column is-8">
        <div class=" card">
          <header class="card-header">
            <p class="card-header-title">
              {{ __('Login') }}
            </p>
          </header>
          <div class="card-content">
            <div class="content">
              <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="field">
                  <label class="label">{{ __('E-Mail Address') }}</label>
                  <div class="control">
                    <input class="input {{ $errors->has('email') ? 'is-danger' : '' }}" type="email" name="email" value="{{ old('email') }}" required autofocus>
                    @if ($errors->has('email'))
                      <p class="help is-danger">{{ $errors->first('email') }}</p>
                    @endif
                  </div>
                </div>
                <div class="field">
                  <label class="label">{{ __('Password') }}</label>
                  <div class="control">
                    <input class="input {{ $errors->has('password') ? 'is-danger' : '' }}" type="password" name="password" required>
                    @if ($errors->has('password'))
                      <p class="help is-danger">{{ $errors->first('password') }}</p>
                    @endif
                  </div>
                </div>
                <div class="field">
                  <div class="control">
                    <label class="checkbox">
                      <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                      {{ __('Remember Me') }}
                    </label>
                  </div>
                </div>

                <div class="field is-grouped">
                  <div class="control">
                    <button class="button is-link">{{ __('Login') }}</button>
                  </div>
                  <div class="control">
                    <a class="button is-text" href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
