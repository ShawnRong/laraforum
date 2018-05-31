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
        @foreach($replies as $reply)
          @include('threads.reply')
        @endforeach
      </div>
      <div class="main-card-top">
        {{ $replies->links('layouts.paginator') }}
      </div>
      <div class="hero main-card-top">
        <article class="media">
          <div class="media-content">
            @if(auth()->check())
            <form action="{{ $thread->path() . '/replies' }}" method="post">
              {{ csrf_field() }}
              <div class="field">
                <p class="control">
                  <textarea class="textarea {{ $errors->has('body') ? 'is-danger' : '' }}" placeholder="Have Something to say?" name="body" id="body"></textarea>
                  @if ($errors->has('body'))
                    <p class="help is-danger">{{ $errors->first('body') }}</p>
                  @endif
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
    <div class="column is-4">
      <div class="card">
        <div class="card-content">
          <div class="content">
            This thread was published {{ $thread->created_at->diffForHumans() }} by
            <a href="#">{{ $thread->creator->name }}</a>, and currently has {{ $thread->replies_count }} {{str_plural('comment', $thread->replies_count)}}.
          </div>
        </div>
      </div>
    </div>
  </div>
 </div>
@endsection

