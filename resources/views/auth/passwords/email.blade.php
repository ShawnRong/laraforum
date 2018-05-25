@extends('layouts.app')

@section('content')
  <div id="reset-email-form" class="container">
    <div class="columns is-centered">
      <div class="column is-8">
        <div class=" card">
          <header class="card-header">
            <p class="card-header-title">
              {{ __('Reset Password') }}
            </p>
          </header>
          <div class="card-content">
            <div class="content">
              @if (session('status'))
                <article class="message is-success">
                  <div class="message-body">
                    {{ session('status') }}
                  </div>
                </article>
              @endif
              <form action="{{ route('password.email') }}" method="POST">
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
                <div class="field is-grouped">
                  <div class="control">
                    <button class="button is-link">{{ __('Send Password Reset Link') }}</button>
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
