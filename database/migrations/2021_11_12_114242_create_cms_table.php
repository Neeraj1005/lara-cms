<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // categories table
        Schema::create('cms_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->nullable();
            $table->string('picture')->nullable()->comment('for image upload');
            $table->timestamps();
        });

        // posts table
        Schema::create('cms_posts', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->longText('body')->nullable();
            $table->string('picture')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreignId('cms_category_id')->nullable()->constrained()->nullOnDelete();
            $table->boolean('published')->default(true)->comment('1 published 0 draft');
            $table->integer('views')->default(0)->comment('total post views');
            $table->boolean('isActive')->default(true)->comment('1 active 0 block');
            $table->boolean('isFeatured')->default(false)->comment('1 featured 0 Not in featured list');
            $table->boolean('needComments')->default(true)->comment('do you want to show comment box or not');
            $table->timestamps();
            $table->softDeletes();
        });

        // tag table
        Schema::create('cms_tags', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->timestamps();
        });

        // pivot table for tag
        Schema::create('cms_post_tag', function (Blueprint $table) {
            $table->foreignId('cms_tag_id')->constrained()->cascadeOnDelete();
            $table->foreignId('cms_post_id')->constrained()->cascadeOnDelete();
            $table->unique(['cms_post_id', 'cms_tag_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cms_post_tag');
        Schema::dropIfExists('cms_posts');
        Schema::dropIfExists('cms_categories');
        Schema::dropIfExists('cms_tags');
    }
}
