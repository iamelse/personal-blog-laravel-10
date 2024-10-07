<?php

namespace Database\Factories;

use App\Enums\PostStatus;
use App\Models\Post;
use App\Models\PostView;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class PostViewFactory extends Factory
{
    protected $model = PostView::class;

    private $generatedDates = [];

    public function definition(): array
    {
        $startDate = Carbon::now()->subDays(6);
        $endDate = Carbon::now();

        $postId = Post::where('status', PostStatus::PUBLISHED)->inRandomOrder()->first()->id;

        $viewDate = $this->generateUniqueDate($postId, $startDate, $endDate);

        return [
            'post_id'    => $postId,
            'view_date'  => $viewDate,
            'view_count' => $this->faker->numberBetween(1000, 100000),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    /**
     * Generate a unique date for the given post_id.
     *
     * @param int $postId
     * @param Carbon $startDate
     * @param Carbon $endDate
     * @return string
     */
    private function generateUniqueDate(int $postId, Carbon $startDate, Carbon $endDate): string
    {
        $attempts = 0;
        do {
            $date = $this->faker->dateTimeBetween($startDate, $endDate)->format('Y-m-d');
            $uniqueKey = "{$postId}-{$date}";
            $attempts++;
        } while (in_array($uniqueKey, $this->generatedDates) && $attempts < 100);

        $this->generatedDates[] = $uniqueKey;

        return $date;
    }
}
