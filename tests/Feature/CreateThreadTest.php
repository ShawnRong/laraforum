<?php

namespace Tests\Feature;

use App\Activity;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class CreateThreadTest extends TestCase
{

    use DatabaseMigrations;

    /** @test */
    function guests_may_not_create_threads()
    {
        $this->withExceptionHandling();

        $this->post('/threads')->assertRedirect('/login');

        $this->get('/threads/create')->assertRedirect('/login');
    }

    /** @test */
    function an_user_can_create_new_forum_threads()
    {
        $this->signIn();

        $thread = make('App\Thread');

        $response = $this->post('/threads', $thread->toArray());
        $this->get($response->headers->get('Location'))
             ->assertSee($thread->title)
             ->assertSee($thread->body);
    }

    /** @test */
    function a_thread_requires_a_title()
    {
        $this->publishThread(['title' => null])
             ->assertSessionHasErrors('title');
    }

    public function publishThread($overrides = [])
    {
        $this->withExceptionHandling()->signIn();

        $thread = make('App\Thread', $overrides);

        return $this->post('/threads', $thread->toArray());
    }

    /** @test */
    function a_thread_requires_a_body()
    {
        $this->publishThread(['body' => null])
             ->assertSessionHasErrors('body');
    }

    /** @test */
    function a_thread_requires_a_valid_channel()
    {
        factory('App\Channel', 2)->create();

        $this->publishThread(['channel_id' => null])
             ->assertSessionHasErrors('channel_id');

        $this->publishThread(['channel_id' => 999])
             ->assertSessionHasErrors('channel_id');
    }

    /** @test */
    public function authorized_users_can_delete_threads()
    {
        $this->signIn();
        $thread   = create('App\Thread', ['user_id' => auth()->id()]);
        $reply    = create('App\Reply', ['thread_id' => $thread->id]);
        $response = $this->json('DELETE', $thread->path());
        $response->assertStatus(204);
        $this->assertDatabaseMissing('threads', ['id' => $thread->id]);
        $this->assertDatabaseMissing('replies', ['id' => $reply->id]);
        $this->assertEquals(0, Activity::count());
        //        $this->assertDatabaseMissing('activities',
        //          ['subject_id' => $thread->id, 'subject_type' => get_class($thread)]);
        //
        //        $this->assertDatabaseMissing('activities',
        //          ['subject_id' => $reply->id, 'subject_type' => get_class($reply)]);
    }

    /** @test */
    public function unauthorized_users_may_not_delete_threads()
    {
        $this->withExceptionHandling();
        $thread   = create('App\Thread');
        $response = $this->delete($thread->path())->assertRedirect('/login');
        $this->signIn();
        $response = $this->delete($thread->path())->assertStatus(403);
    }

    public function threads_may_only_be_deleted_by_those_who_have_permission()
    {
        //TODO:
    }

    /** @test */
    public function new_users_must_first_confirm_their_email_address_before_creating_threads(
    )
    {
        $user = factory('App\User')->states('unconfirmed')->create();
        $this->withExceptionHandling()->signIn($user);

        $thread = make('App\Thread');

        $this->post('/threads', $thread->toArray())
             ->assertRedirect('/threads')
             ->assertSessionHas('flash',
               'You must first confirm your email address.');
    }
}
