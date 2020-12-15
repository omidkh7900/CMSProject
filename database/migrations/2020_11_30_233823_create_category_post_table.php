<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use \App\Models\Post;
use \App\Models\Category;

class CreateCategoryPostTable extends Migration
{
    public function up()
    {
        Schema::create('category_post', function (Blueprint $table) {
            $table->foreignIdFor(Post::class);
            $table->foreignIdFor(Category::class);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('category_post');
    }
}
