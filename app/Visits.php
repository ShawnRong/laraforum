<?php


namespace App;

use Illuminate\Support\Facades\Redis;

class Visits
{

    protected $thread;

    public function __construct($thread)
    {
        $this->thread = $thread;
    }

    public function reset()
    {
        Redis::del($this->cacheKey());
    }

    protected function cacheKey()
    {
        return "threads.{$this->thread->id}.visits";
    }

    public function count()
    {
        return Redis::get($this->cacheKey()) ?? 0;
    }

    public function record()
    {
        Redis::incr("threads.{$this->thread->id}.visits");
    }
}