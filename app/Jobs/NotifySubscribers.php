<?php

namespace App\Jobs;

use App\Models\Post;
use App\Models\Subscribe;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Artisan;

class NotifySubscribers implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private Post $post;

    /**
     * Create a new job instance.
     */
    public function __construct(Post $post)
    {
        //
        $this->post = $post;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
       Artisan::call('app:send-subscribe-notifications-command',[
           'postId' => $this->post->id
       ]);
    }
}
