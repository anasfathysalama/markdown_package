<?php


namespace Anas\Markdown\database\factories;

use Anas\Markdown\Models\Post;
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

    public function definition()
    {
        return [
            'identifier' => Str::random(),
            'slug' => Str::slug($this->faker->sentence()),
            'title' => $this->faker->sentence(),
            'body' => $this->faker->paragraph(),
            'extra' => json_encode(['test' => 'value']),
        ];
    }
}