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
      @forelse($activities as $date => $activity)
        <div class="title is-3 main-card-top">
          {{ $date }}
        </div>
        <hr>
        @foreach($activity as $record)
          @if(view()->exists("profiles.activities.{$record->type}"))
            @include("profiles.activities.{$record->type}", ['activity' => $record])
          @endif
        @endforeach
      @empty
        <p>There is no activity for this user yet.</p>
      @endforelse
    </div>
  </div>
@endsection
