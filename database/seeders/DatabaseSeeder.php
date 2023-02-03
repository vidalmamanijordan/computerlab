<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    
    public function run()
    {
        Storage::deleteDirectory('public/articles');
        Storage::makeDirectory('public/articles');
        
        $this->call(UserSeeder::class);
        $this->call(LaboratorySeeder::class);
        /* $this->call(ArticleSeeder::class); */
        Article::factory(40)->create();
    }
}
