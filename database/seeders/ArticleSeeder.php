<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Article;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 20; $i++) {
            $createdAt = $faker->dateTimeBetween('-1 year', 'now');
            $content = $faker->text($faker->numberBetween(800, 900));
            Article::insert([
                'user_id' => 1,
                'title' => $faker->sentence,
                'content' => $content,
                'image' => $faker->imageUrl(1280, 960, 'cats', true),
                'likes' => $faker->numberBetween(0, 10),
                'views' => $faker->numberBetween(0, 100),
                'status' => 'published',
                'created_at' => $createdAt,
                'updated_at' => $faker->dateTimeBetween($createdAt, 'now'),
            ]);
        }
    }
}
