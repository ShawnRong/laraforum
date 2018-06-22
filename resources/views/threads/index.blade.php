@extends('layouts.app')

@section('content')
  <div class="container main-card-top">
    <div class="columns is-centered">
      <div class="column is-8">
          @forelse($threads as $thread)
          <div class="card main-card-top">
            <header class="card-header">
              <p class="card-header-title">
                <a href="{{ $thread->path() }}">
                  @if(auth()->check() && $thread->hasUpdatesFor(auth()->user()))
                    {{ $thread->title }}
                  @else
                    <span class="has-read">
                      {{ $thread->title }}
                    </span>
                  @endif
                </a>
              </p>
              <p class="card-header-icon">
                <a href="{{ $thread->path() }}">
                  {{ $thread->replies_count }} {{ str_plural('reply', $thread->replies_count) }}
                </a>
              </p>
            </header>
            <div class="card-content">
              <div class="content">
                {{ $thread->body }}
              </div>
            </div>
          </div>
          @empty
            <p>There are no relevant results at this time.</p>
          @endforelse
      </div>
    </div>
  </div>
@endsection
