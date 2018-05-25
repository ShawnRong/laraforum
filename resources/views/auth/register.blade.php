@extends('layouts.app')

@section('content')
  <div id="register-form" class="container">
    <div class="columns is-centered">
      <div class="column is-8">
        <div class=" card">
          <header class="card-header">
            <p class="card-header-title">
              {{ __('Register') }}
            </p>
          </header>
          <div class="card-content">
            <div class="content">
              <form action="{{ route('register') }}" method="POST">
                @csrf
                <div class="field">
                  <label class="label">{{ __('Name') }}</label>
                  <div class="control">
                    <input class="input {{ $errors->has('name') ? 'is-danger' : '' }}" type="text" name="name" value="{{ old('name') }}" required autofocus>
                    @if ($errors->has('name'))
                      <p class="help is-danger">{{ $errors->first('name') }}</p>
                    @endif
                  </div>
                </div>
                <div class="field">
                  <label class="label">{{ __('E-Mail Address') }}</label>
                  <div class="control">
                    <input class="input {{ $errors->has('email') ? 'is-danger' : '' }}" type="email" name="email" value="{{ old('email') }}" required>
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
                  <label class="label">{{ __('Confirm Password') }}</label>
                  <div class="control">
                    <input class="input" type="password" name="password_confirmation" required>
                  </div>
                </div>
                <div class="field is-grouped">
                  <div class="control">
                    <button class="button is-link">{{ __('Register') }}</button>
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
