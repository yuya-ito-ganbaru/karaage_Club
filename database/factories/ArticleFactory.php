<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Article;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    protected $model = Article::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        
        return [
            //
            'user_id' => User::factory()->create()->id,
            'title' => $this->faker->sentence,
            'tag' => $this->faker->word,
            'body' => $this->faker->paragraph,
            'recommend' => rand(1, 5),
        ];
    }
}
