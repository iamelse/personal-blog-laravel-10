<?php

namespace App\Console\Commands;

use App\Enums\PostStatus;
use App\Models\Post;
use App\Notifications\PostPublishedNotification;
use Illuminate\Console\Command;

class PublishScheduledPosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'posts:publish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to publish user posts';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $posts = Post::where('published_at', '<=', now())
                    ->where('status', 'scheduled')
                    ->get();

        foreach ($posts as $post) {
            $post->status = PostStatus::PUBLISHED;
            $post->save();

            // Send notification to the user after the post is published
            $post->author->notify(new PostPublishedNotification($post));

            $this->info("Post '{$post->title}' published and notification sent to user.");
        }

        $this->info('Scheduled posts published successfully.');
    }
}