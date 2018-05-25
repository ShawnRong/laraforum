@extends('layouts.app')

@section('content')
  <div class="container main-card-top">
    <div class="columns is-centered">
      <div class="column is-8">
        <div class=" card">
          <header class="card-header">
            <p class="card-header-title">
              Create a New Thread
            </p>
          </header>
          <div class="card-content">
            <div class="content">
              <form action="{{ route('threads.store') }}" method="POST">
                {{ csrf_field() }}
                <div class="field">
                  <label class="label">{{ __('Title') }}:</label>
                  <div class="control">
                    <input class="input" type="text" name="title" value="{{ old('title') }}" required autofocus>
                  </div>
                </div>
                <div class="field">
                  <label class="label">{{ __('Body') }}:</label>
                  <div class="control">
                    <textarea class="textarea" name="body"></textarea>
                  </div>
                </div>
                <div class="field is-grouped">
                  <div class="control">
                    <button class="button is-link">{{ __('Publish') }}</button>
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
