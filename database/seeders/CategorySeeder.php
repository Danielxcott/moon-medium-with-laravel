<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['News','Daily Blogs','Health','Movie','Foods & Drinks','Music','Science','IT','Arts & Entertainment','Sports & Gamings','lifestyle'];

        foreach($categories as $category)
        {
            Category::factory()->create([
                "name" => $category,
                "slug" => Str::slug($category),
                "color" => "#FFC090",
                "user_id" => "1",
            ]);
        }
    }
}
