<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCmsPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_posts', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('slug')->unique()->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            // $table->foreignId('category_id')->constrained();
            // $table->foreignId('subcategory_id')->nullable()->constrained();
            $table->text('body')->nullable();
            $table->boolean('published')->default(true)->comment('1 published 0 draft');
            $table->integer('views')->default(0)->comment('post_views');
            $table->boolean('isactive')->default(true)->comment('1 active 0 block');
            $table->boolean('featured')->default(false)->comment('1 featured 0 Not in featured list');
            $table->boolean('commentActive')->default(true)->comment('if true then comment box displayed otherwise not');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cms_posts');
    }
}
