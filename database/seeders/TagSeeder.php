<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Article;
use App\Models\Tag;
use App\Models\ArticleTag;
use Illuminate\Support\Str;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Создание тегов
        $tags = [];
        for ($i = 0; $i < rand(5, 15); $i++) {
            $label = $faker->word;
            $tags[] = [
                'label' => $label,
                'url' => Str::slug($label),
            ];
        }
        Tag::insert($tags);

        // Создание связей между статьями и тегами
        $articles = Article::pluck('id')->toArray();
        foreach ($articles as $articleId) {
            $tagIds = array_rand($tags, rand(1, count($tags)));
            if (!is_array($tagIds)) {
                $tagIds = [$tagIds];
            }
            foreach ($tagIds as $tagId) {
                ArticleTag::insert([
                    'article_id' => $articleId,
                    'tag_id' => $tagId + 1,
                ]);
            }
        }
    }
}
