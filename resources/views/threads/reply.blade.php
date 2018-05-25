<div class="card reply-item-top">
  <header class="card-header">
    <p class="card-header-title">
      <a href="#">
        {{ $reply->owner->name }}
      </a> said:
      {{ $reply->created_at->diffForHumans() }}
    </p>
  </header>
  <div class="card-content">
    <div class="content">
      {{ $reply->body }}
    </div>
  </div>
</div>

