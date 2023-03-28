<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\Laboratory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name = $this->faker->sentence();

        return [
            'name' => $name,
            'description' => $this->faker->paragraph(),
            'image' => 'articles/' . $this->faker->image('public/storage/articles', 640, 480, null, false),
            'status' => $this->faker->randomElement([Article::DESACTIVO, Article::ACTIVO]),
            'owner' => null,
            'user_id' => User::all()->random()->id,
            'laboratory_id' => Laboratory::all()->random()->id
        ];
    }
}
