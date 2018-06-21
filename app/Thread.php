<?php

namespace App;

use App\Events\ThreadHasNewReply;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{

    use RecordsActivity;

    protected $guarded = [];

    protected $with = ['creator', 'channel'];

    protected $appends = ['isSubscribedTo'];

    public static function boot()
    {
        parent::boot();
        //        static::addGlobalScope('replyCount', function ($builder) {
        //            $builder->withCount('replies');
        //        });

        static::deleting(function ($thread) {
            $thread->replies->each->delete();
        });
    }

    public function getReplyCountAttribute()
    {
        return $this->replies()->count();
    }

    public function replies()
    {
        return $this->hasMany(Reply::class)
                    ->withCount('favorites')
                    ->with('owner');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function addReply($reply)
    {
        $reply = $this->replies()->create($reply);

        //Prepare notifications for all subscribers.
        $this->notifySubscribers($reply);
        //        event(new ThreadHasNewReply($this, $reply));
        //        $this->subscriptions->filter(function ($sub) use ($reply) {
        //            return $sub->user_id != $reply->user_id;
        //        })->each->notify($reply);

        return $reply;
    }

    public function notifySubscribers($reply)
    {
        $this->subscriptions->where('user_id', '!=',
          $reply->user_id)
          ->each->notify($reply);
    }

    public function path()
    {
        return "/threads/{$this->channel->slug}/{$this->id}";
    }

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }

    public function subscribe($userId = null)
    {
        $this->subscriptions()->create([
          'user_id' => $userId ? : auth()->id(),
        ]);

        return $this;
    }

    public function subscriptions()
    {
        return $this->hasMany(ThreadSubscription::class);
    }

    public function unsubscribe($userId = null)
    {
        $this->subscriptions()
             ->where('user_id', $userId ? : auth()->id())
             ->delete();
    }

    public function getIsSubscribedToAttribute()
    {
        return $this->subscriptions()->where('user_id', auth()->id())->exists();
    }

    public function hasUpdatesFor($user)
    {
        //Look in the cache for the proper key
        //compare carbon instance with the $thread->updated_at
        $key = $user->visitedThreadCachedKey($this);
        return $this->updated_at > cache($key);
    }
}
