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
    </div>
  </div>
@endsection
