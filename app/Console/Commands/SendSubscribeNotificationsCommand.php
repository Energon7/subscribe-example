<?php

namespace App\Console\Commands;

use App\Mail\SubscriberMail;
use App\Models\NotifiedSubscribe;
use App\Models\Post;
use App\Models\Subscribe;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendSubscribeNotificationsCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-subscribe-notifications-command {postId}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $postId = $this->argument('postId');
        $post = Post::query()->findOrFail($postId);

        $subscribers = Subscribe::query()
            ->where('website_id', $post->website_id)
            ->whereDoesntHave('notified_subscribers', fn($query) => $query->where('post_id', $post->id))
            ->get();

        foreach($subscribers as $subscriber) {

            Mail::to($subscriber->email)->queue(new SubscriberMail($post));

            $subscriber->notified_subscribers()->create([
                'post_id' => $post->id
            ]);
        }

    }
}
