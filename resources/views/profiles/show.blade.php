@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="profile main-card-top">
      <span class="title is-1">
        {{ $profileUser->name }}
      </span>
      Since {{ $profileUser->created_at->diffForHumans() }}
    </div>
    <hr>
    <div class="container">
      @foreach($threads as $thread)
        <div class="card">
          <header class="card-header">
            <p class="card-header-title">
              {{ $thread->title }}
            </p>
            <p class="card-header-icon">
              {{ $thread->created_at->diffForHumans() }}
            </p>
          </header>
          <div class="card-content">
            <div class="content">
              {{ $thread->body }}
            </div>
          </div>
        </div>
      @endforeach
      {{ $threads->links('layouts.paginator') }}
    </div>
  </div>
@endsection
