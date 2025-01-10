<?php

namespace App\Console\Commands;

use App\Enums\PostStatus;
use App\Models\Post;
use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate-sitemap';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate the sitemap.xml file';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $sitemap = Sitemap::create();

        $posts = Post::where('status', PostStatus::PUBLISHED->value)->get();

        foreach ($posts as $post) {
            $sitemap->add(
                Url::create("/article/{$post->slug}")
                    ->setPriority(0.7)
                    ->setChangeFrequency('daily')
                    ->setLastModificationDate($post->updated_at)
            );
        }

        $sitemap->writeToFile(public_path('sitemap.xml'));

        $this->info('Article sitemap generated successfully!');
    }
}
