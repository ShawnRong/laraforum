<div class="navbar is-transparent is-info">
  <div class="navbar-brand">
    <a class="navbar-item" href="{{ route('home') }}">
      {{ config('app.name', 'Laravel') }}
    </a>
    <div class="navbar-burger burger" data-target="navbarExampleTransparentExample">
      <span></span>
      <span></span>
      <span></span>
    </div>
  </div>

  <div id="head-nav-bar" class="navbar-menu">
    <div class="navbar-start">
      <div class="navbar-item has-dropdown is-hoverable">
        <a class="navbar-link">
          Browse
        </a>
        <div class="navbar-dropdown is-boxed">
          <a class="navbar-item" href="{{ route('threads.index') }}">
            All Threads
          </a>
          @if(auth()->check())
          <a class="navbar-item" href="{{ route('threads.index') . '?by=' . auth()->user()->name }}">
            My Threads
          </a>
          @endif
          <a class="navbar-item" href="{{ route('threads.index') . '?popular=1'}}">
            Popular Threads
          </a>
          <a class="navbar-item" href="{{ route('threads.index') . '?unanswered=1'}}">
            Unanswered Threads
          </a>
        </div>
      </div>
      <a class="navbar-item" href="{{ route('threads.create') }}">
        New Thread
      </a>
      <div class="navbar-item has-dropdown is-hoverable">
        <a class="navbar-link">
          Channels
        </a>
        <div class="navbar-dropdown is-boxed">
          @foreach($channels as $channel)
            <a class="navbar-item" href="/threads/{{ $channel->slug }}">
              {{ $channel->name }}
            </a>
          @endforeach
        </div>
      </div>
    </div>
    </div>

    <div class="navbar-end">
      @guest
        <a class="navbar-item" href="{{ route('login') }}">
          {{ __('Login') }}
        </a>
        <a class="navbar-item" href="{{ route('register') }}">
          {{ __('Register') }}
        </a>
      @else
      <div class="navbar-item has-dropdown is-hoverable">
        <a class="navbar-link" href="#">
          {{ Auth::user()->name }}
        </a>
        <div class="navbar-dropdown is-right is-boxed">
          <a href="{{ route('profile', Auth::user()) }}" class="navbar-item">My Profile</a>
          <a class="navbar-item" href="{{ route('logout') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
          </form>
        </div>
      </div>
      @endguest
    </div>
  </div>
