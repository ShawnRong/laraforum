<div class="card reply-item-top">
  <header class="card-header">
    <p class="card-header-title">
      <a href="{{ route('profile', $reply->owner) }}">
        {{ $reply->owner->name }}
      </a> said:
      {{ $reply->created_at->diffForHumans() }}
    </p>
    <form action="{{ route('add_favorite_to_reply', $reply) }}" method="POST">
      {{ csrf_field() }}
      <span class="icon is-large">
        <button type="submit" {{ $reply->isFavorited() ? 'disabled class=is-red': '' }} >
          <i class="ion-md-heart"></i>
          {{ $reply->favorites_count }}
        </button>
      </span>
    </form>
  </header>
  <div class="card-content">
    <div class="content">
      {{ $reply->body }}
    </div>
  </div>
</div>
