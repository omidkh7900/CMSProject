<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\CategoryPost;
use App\Models\Image;
use App\Models\post;
use App\Models\PostTag;
use App\Models\tag;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(20)->create();
        Category::factory(50)->create()->each(function ($category){
            Image::factory(rand(0,1))->create(['imageable_type'=>Category::class,'imageable_id'=>$category->id]);
        });
        tag::factory(100)->create();
        post::factory(2000)
            ->has(Image::factory())
            ->create()->each(function ($post){
            CategoryPost::factory(rand(1,5))->create(['post_id'=>$post->id]);
            PostTag::factory(rand(3,10))->create(['post_id'=>$post->id]);
            });
    }
}
