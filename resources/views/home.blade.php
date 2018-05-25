@extends('layouts.app')

@section('content')
<div id="dashboard" class="container">
    <div class="columns is-centered">
      <div class="column is-8">
        <div class=" card">
          <header class="card-header">
            <p class="card-header-title">
              Dashboard
            </p>
          </header>
          <div class="card-content">
            <div class="content">
              @if (session('status'))
                <article class="message is-success">
                  <div class="message-body">
                    {{ session('status') }}
                  </div>
                </article>
              @endif
              You are logged in!
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection
