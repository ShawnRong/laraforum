<nav class="navbar is-transparent is-info">
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
      <a class="navbar-item" href="{{ route('threads') }}">
        All Threads
      </a>
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
</nav>