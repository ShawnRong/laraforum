<reply :attributes="{{ $reply }}" inline-template v-cloak>
  <div id="reply-{{ $reply->id }}" class="card reply-item-top">
    <header class="card-header">
      <p class="card-header-title">
        <a href="{{ route('profile', $reply->owner) }}">
          {{ $reply->owner->name }}
        </a> said:
        {{ $reply->created_at->diffForHumans() }}
      </p>
      @if(Auth::check())
        <favorite :reply="{{ $reply }}"></favorite>
      @endif
    </header>
    <div class="card-content">
      <div class="content">
        <div v-if="editing">
          <textarea class="textarea" v-model="body"></textarea>
          <div class="container reply-btn-padding">
            <button class="button is-info" @click="update">Update</button>
            <button class="button is-danger" @click="editing = false">Cancel</button>
          </div>
        </div>
        <div v-else v-text="body"></div>
      </div>
    </div>
    @can('update', $reply)
    <footer class="card-footer">
      <a href="#" class="card-footer-item" @click="editing = true">Edit</a>
      <a href="#" class="card-footer-item" @click="destroy">Delete</a>
    </footer>
    @endcan
  </div>
</reply>
