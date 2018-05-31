<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ReadThreadsTest extends TestCase
{

    /**
     * Run php artisan migrate before every test
     * migrate:rollback after every test
     */
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();

        $this->thread = factory('App\Thread')->create();
    }

    /**
     * A user can view all threads
     *
     * @test
     * @return void
     */
    public function a_user_can_view_all_threads()
    {
        $response = $this->get('/threads')
                         ->assertSee($this->thread->title);
    }

    /**
     * A user can read a single thread
     *
     * @test
     */
    public function a_user_can_read_a_single_thread()
    {
        $response = $this->get($this->thread->path())
                         ->assertSee($this->thread->title);
    }

    /** @test */
    public function a_user_can_read_replies_associated_with_a_thread()
    {
        $reply = create('App\Reply', ['thread_id' => $this->thread->id]);
        $this->get($this->thread->path())
             ->assertSee($reply->body);
    }

    /** @test */
    public function a_user_filter_threads_according_to_a_channel()
    {
        $channel            = create('App\Channel');
        $threadInChannel    = create('App\Thread',
          ['channel_id' => $channel->id]);
        $threadNotInChannel = create('App\Thread');
        $this->get('/threads/' . $channel->slug)
             ->assertSee($threadInChannel->title)
             ->assertDontSee($threadNotInChannel->title);
    }

    /** @test */
    public function a_user_can_filter_threads_by_any_username()
    {
        $this->signIn(create('App\User', ['name' => 'JohnDoe']));

        $threadByJohn    = create('App\Thread', ['user_id' => auth()->id()]);
        $threadNotByJohn = create('App\Thread');
        $this->get('threads?by=JohnDoe')
             ->assertSee($threadByJohn->title)
             ->assertDontSee($threadNotByJohn->title);
    }
}
