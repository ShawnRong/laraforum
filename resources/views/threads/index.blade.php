@extends('layouts.app')

@section('content')
  <div class="container main-card-top">
    <div class="columns is-centered">
      <div class="column is-8">
        <div class=" card">
          <header class="card-header">
            <p class="card-header-title">
              Forum Threads
            </p>
          </header>
          <div class="card-content">
            <div class="content">
              @foreach($threads as $thread)
                <article>
                  <div class="columns">
                    <div class="column is-10">
                      <a href="{{ $thread->path() }}">
                        <h4>{{ $thread->title }}</h4>
                      </a>
                    </div>
                    <div class="column is-2">
                      <a href="{{ $thread->path() }}">
                        {{ $thread->replies_count }} {{ str_plural('reply', $thread->replies_count) }}
                      </a>
                    </div>
                  </div>
                  <div class="body">{{ $thread->body }}</div>
                </article>
                <hr>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
