<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\image;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $articles = Article::factory(40)->create();

        foreach ($articles as $article) {
            Image::factory(1)->create([
                'imageable_id' => $article->id,
                'imageable_type' => Article::class
            ]);
        }
    }
}
