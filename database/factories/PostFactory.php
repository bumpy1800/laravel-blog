<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Post;
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
        return [
            'title' => $this->faker->realText(30),
            'writer' => $this->faker->realText(10),
            'content' => $this->faker->realText(),
            'created_at' => $this->faker->dateTimeBetween('-2 years', 'now'),
        ];
    }
}
