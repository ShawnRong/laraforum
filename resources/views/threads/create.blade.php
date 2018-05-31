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
                @if(count($errors))
                <article class="message is-danger">
                  <div class="message-body">
                    <ul>
                      @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                      @endforeach
                    </ul>
                  </div>
                </article>
                @endif
                {{ csrf_field() }}
                <div class="field">
                  <div class="select">
                    <select name="channel_id" required>
                      <option value="">Choose a Channel:</option>
                      @foreach($channels as $channel)
                        <option value="{{ $channel->id}}" {{ old('channel_id') === $channel->id ? 'selected' : '' }}>{{ $channel->name }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="field">
                  <label class="label">{{ __('Title') }}:</label>
                  <div class="control">
                    <input class="input {{ $errors->has('title') ? 'is-danger' : '' }}" type="text" name="title" value="{{ old('title') }}" required autofocus>
                    @if ($errors->has('title'))
                      <p class="help is-danger">{{ $errors->first('title') }}</p>
                    @endif
                  </div>
                </div>
                <div class="field">
                  <label class="label">{{ __('Body') }}:</label>
                  <div class="control">
                    <textarea class="textarea {{ $errors->has('title') ? 'is-danger' : '' }}" name="body" value="{{ old('body') }}"></textarea>
                    @if ($errors->has('title'))
                      <p class="help is-danger">{{ $errors->first('title') }}</p>
                    @endif
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
