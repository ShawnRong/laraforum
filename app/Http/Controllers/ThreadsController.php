<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Filters\ThreadFilters;
use App\Thread;
use App\Trending;
use Illuminate\Http\Request;

class ThreadsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index(
      Channel $channel,
      ThreadFilters $filters,
      Trending $trending
    ) {
        $threads = $this->getThreads($channel, $filters);

        if (request()->wantsJson()) {
            return $threads;
        }

        return view('threads.index',
          ['threads' => $threads, 'trending' => $trending->get()]);
    }

    /**
     * @param \App\Channel $channel
     * @param \App\Filters\ThreadFilters $filters
     *
     * @return mixed
     */
    protected function getThreads(Channel $channel, ThreadFilters $filters)
    {
        $threads = Thread::latest()->filter($filters);
        if ($channel->exists) {
            $threads->where('channel_id', $channel->id);
        }
        $threads = $threads->paginate(25);
        return $threads;
    }

    public function show($channelId, Thread $thread, Trending $trending)
    {
        //Record that user visited this page
        //Record a timestamp
        if (auth()->check()) {
            auth()->user()->read($thread);
        }

        $trending->push($thread);
        $thread->visits()->record();

        return view('threads.show', compact('thread'));
    }

    public function create()
    {
        return view('threads.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
          'title'      => 'required|spamfree',
          'body'       => 'required|spamfree',
          'channel_id' => 'required|exists:channels,id',
        ]);


        $thread = Thread::create([
          'user_id'    => auth()->id(),
          'channel_id' => request('channel_id'),
          'title'      => request('title'),
          'body'       => request('body'),
        ]);
        return redirect($thread->path())->with('flash',
          'Your thread has been published!');
    }

    public function destroy($channel, Thread $thread)
    {
        $this->authorize('update', $thread);
        //        if($thread->user_id != auth()->id()) {
        //            abort(403, 'You do not have permission to do this.');
        //            if(request()->wantsJson()) {
        //                return response(['status' => 'Permission Denied'], 403);
        //            }
        //            return redirect('/login');
        //        }

        $thread->delete();
        if (request()->wantsJson()) {
            return response([], 204);
        }
        return redirect('/threads');
    }
}
