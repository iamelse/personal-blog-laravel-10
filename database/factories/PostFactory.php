<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\PostCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $categoryId = PostCategory::inRandomOrder()->value('id');
        $userId = User::inRandomOrder()->value('id');

        $statusOptions = ['draft', 'published'];
        
        $randomKey = array_rand($statusOptions);
        
        $status = $statusOptions[$randomKey];

        $data = [
            'user_id' => $userId,
            'cover' => $this->faker->imageUrl(),
            'title' => $this->faker->sentence,
            'slug' => $this->faker->unique()->slug,
            'body' => $this->faker->paragraphs(3, true),
            'post_category_id' => $categoryId,
            'status' => $status,
        ];

        if ($status === 'published') {
            $data['published_at'] = now();
        }

        return $data;
    }
}
