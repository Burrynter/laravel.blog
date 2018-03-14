<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagsAndNullableCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name');
            $table->string('slug');
            $table->integer('user_id');
        });

        Schema::create('post_tag', function (Blueprint $table) {
            $table->integer('post_id')->nullable();
            $table->integer('tag_id')->nullable();
        });
        
        Schema::table('posts', function($table)
        {
            $table->integer('category_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tags');
        Schema::dropIfExists('post_tag');
        
        Schema::table('posts', function($table)
        {
            $table->string('category_id')->nullable(false)->change();
        });
    }
}
