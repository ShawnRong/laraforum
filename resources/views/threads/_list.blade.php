@forelse($threads as $thread)
  <div class="card main-card-top">
    <header class="card-header">
      <div class="column">
        <div class="columns is-vertical-columns">
          <div class="column">
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
          </div>
          <div class="column">
            <p class="thread-user-info"> Posted By: <a href="{{ route('profile', $thread->creator) }}">{{ $thread->creator->name }}</a></p>
          </div>
        </div>
      </div>
      <div class="column is-2">
        <p class="card-header-icon">
          <a href="{{ $thread->path() }}">
            {{ $thread->replies_count }} {{ str_plural('reply', $thread->replies_count) }}
          </a>
        </p>
      </div>
    </header>
    <div class="card-content">
      <div class="content">
        {{ $thread->body }}
      </div>
    </div>
    <footer class="card-footer">
      <div class="card-footer-item">
        {{ $thread->visits()->count() }} Visits
      </div>
      <div class="card-footer-item">
      </div>
      <div class="card-footer-item">
      </div>
      <div class="card-footer-item">
      </div>
    </footer>
  </div>
@empty
  <p>There are no relevant results at this time.</p>
@endforelse
