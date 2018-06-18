@extends('layouts.app')

@section('content')
 <thread-view :initial-replies-count="{{ $thread->replies_count }}" inline-template>
  <div class="container main-card-top">
    <div class="columns is-centered">
      <div class="column is-8">
        <div class="card">
          <header class="card-header">
            <p class="card-header-title">
              <a href="{{ route('profile', $thread->creator) }}">
                {{ $thread->creator->name }}
              </a> posted:
              {{ $thread->title }}
            </p>
            @can('update', $thread)
              <form action="{{ $thread->path() }}" method="POST">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <span class="icon is-large">
                <button type="submit">
                  <i class="ion-md-trash"></i>
                </button>
              </span>
              </form>
            @endcan
          </header>
          <div class="card-content">
            <div class="content">
              {{ $thread->body }}
            </div>
          </div>
        </div>

        <!-- Reply List -->
        <replies :data="{{ $thread->replies }}" @added="repliesCount++" @removed="repliesCount--"></replies>
        {{--<div class="hero">--}}
          {{--@foreach($replies as $reply)--}}
            {{--@include('threads.reply')--}}
          {{--@endforeach--}}
        {{--</div>--}}
        {{--<div class="main-card-top">--}}
          {{--{{ $replies->links('layouts.paginator') }}--}}
        {{--</div>--}}
      </div>
      <div class="column is-4">
        <div class="card">
          <div class="card-content">
            <div class="content">
              This thread was published {{ $thread->created_at->diffForHumans() }} by
              <a href="#">{{ $thread->creator->name }}</a>, and currently has <span v-text="repliesCount"></span> {{str_plural('comment', $thread->replies_count)}}.
            </div>
          </div>
        </div>
      </div>
    </div>
   </div>
</thread-view>
@endsection
