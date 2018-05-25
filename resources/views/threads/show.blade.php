@extends('layouts.app')

@section('content')
<div class="container main-card-top">
  <div class="columns is-centered">
    <div class="column is-8">
      <div class="card">
        <header class="card-header">
          <p class="card-header-title">
            <a href="#">
              {{ $thread->creator->name }}
            </a> posted:
            {{ $thread->title }}
          </p>
        </header>
        <div class="card-content">
          <div class="content">
            {{ $thread->body }}
          </div>
        </div>
      </div>

      <!-- Reply List -->
      <div class="hero">
        @foreach($thread->replies as $reply)
          @include('threads.reply')
        @endforeach
      </div>
      <div class="hero main-card-top">
        <article class="media">
          <div class="media-content">
            @if(auth()->check())
            <form action="{{ route('add_reply_to_thread', $thread) }}" method="post">
              {{ csrf_field() }}
              <div class="field">
                <p class="control">
                  <textarea class="textarea" placeholder="Have Something to say?" name="body" id="body"></textarea>
                </p>
              </div>
              <nav class="level">
                <div class="level-left">
                  <button class="button is-info" type="submit">Post</button>
                </div>
              </nav>
            </form>
            @else
              <p>Please <a href="{{ route('login') }}">sign in</a> to participate in this discussion</p>
            @endif
          </div>
        </article>
      </div>
    </div>
  </div>
 </div>
@endsection

