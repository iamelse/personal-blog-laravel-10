<?php

namespace App\Console\Commands;

use App\Enums\PostStatus;
use App\Models\Post;
use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use Illuminate\Support\Facades\File;

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

        // Determine the write path based on FILESYSTEM_DISK
        $disk = env('FILESYSTEM_DISK', 'public');
        $filePath = $disk === 'public'
            ? public_path('sitemap.xml')
            : $this->getPublicUploadsPath('sitemap.xml');

        // Write the sitemap to the determined path
        $sitemap->writeToFile($filePath);

        $this->info("Sitemap generated successfully at: $filePath");
    }

    /**
     * Get the path for public uploads.
     *
     * @param string $fileName
     * @return string
     */
    protected function getPublicUploadsPath(string $fileName): string
    {
        $directory = '../public_html';

        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        return $directory . '/' . $fileName;
    }
}
