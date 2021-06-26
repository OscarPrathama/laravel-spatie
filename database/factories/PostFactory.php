<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
        $title = $this->faker->sentence();
        return [
            'post_title' => $title,
            'post_slug' => Str::slug($title),
            'post_type' => $this->faker->randomElement(['post', 'page']),
            'post_content' => $this->faker->paragraph(13),
            'created_at' => $this->faker->dateTimeBetween('-5 year', '-10 days'),
            'updated_at' => $this->faker->dateTimeBetween('-4 year', '-12 days'),
        ];
    }
}
