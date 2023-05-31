<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    public function definition()
    {
        return [
            'no' => $this->faker->randomDigit,
            'title' => $this->faker->title,
            // 'content' => $this->faker->text,
            'source' => $this->faker->slug(10),
            'url' => $this->faker->url,
        ];
    }
}
