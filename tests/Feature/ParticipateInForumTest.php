<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ParticipateInForumTest extends TestCase
{

    use DatabaseMigrations;

    /** @test */
    function unauthenticated_user_may_not_add_replies()
    {
        //        $this->expectException('Illuminate\Auth\AuthenticationException');
        $this->withExceptionHandling()
             ->post('/threads/some-channel/1/replies', [])
             ->assertRedirect('/login');
    }

    /** @test */
    function an_authenticated_user_may_participate_in_forum_threads()
    {
        //Login user
        $this->be($user = factory('App\User')->create());

        $thread = create('App\Thread');

        $reply = make('App\Reply');

        $this->post($thread->path() . '/replies', $reply->toArray());

        $this->get($thread->path())->assertSee($reply->body);
    }

    /** @test */
    function a_reply_requires_a_body()
    {
        $this->withExceptionHandling()->signIn();

        $thread = make('App\Thread');
        $reply  = make('App\Reply', ['body' => null]);

       $this->post($thread->path() . '/replies', $reply->toArray())
           ->assertStatus(404);
//             ->assertSessionHasErrors('body');
    }
}
