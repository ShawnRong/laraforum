@extends('layouts.app')

@section('content')
  <div class="container main-card-top">
    <div class="columns is-centered">
      <div class="column is-8">
        @include('threads._list')
        <div class="column">
          {{ $threads->links('layouts.paginator') }}
        </div>
      </div>
      <div class="column">
        @if(count($trending))
        <div class="card">
          <header class="card-header">
            <p class="card-header-title">
              Trending Threads
            </p>
          </header>
          <div class="card-content">
            <ul>
              @foreach($trending as $thread)
                <li>
                  <a href="{{ url($thread->path) }}">
                    {{ $thread->title }}
                  </a>
                </li>
              @endforeach
            </ul>
          </div>
        </div>
        @endif
      </div>
    </div>
  </div>
@endsection
