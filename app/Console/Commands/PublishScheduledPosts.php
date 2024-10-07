<?php

namespace App\Console\Commands;

use App\Enums\PostStatus;
use App\Models\Post;
use Illuminate\Console\Command;

class PublishScheduledPosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    //protected $signature = 'app:publish-scheduled-posts';
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
        }

        $this->info('Scheduled posts published successfully.');
    }
}
