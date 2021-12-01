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

        // medialibrary migration
        Schema::create('media', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->morphs('model');
            $table->uuid('uuid')->nullable()->unique();
            $table->string('collection_name');
            $table->string('name');
            $table->string('file_name');
            $table->string('mime_type')->nullable();
            $table->string('disk');
            $table->string('conversions_disk')->nullable();
            $table->unsignedBigInteger('size');
            $table->json('manipulations');
            $table->json('custom_properties');
            $table->json('generated_conversions');
            $table->json('responsive_images');
            $table->unsignedInteger('order_column')->nullable();

            $table->nullableTimestamps();
        });

        Schema::create('cms_seos', function (Blueprint $table) {
            $table->id();
            $table->string('site_title')->nullable();
            $table->longText('site_description')->nullable();
            $table->string('logo')->nullable();
            $table->timestamps();
        });

        Schema::create('cms_menus', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->boolean('placed_in')->default(true)->comment('1 for header 0 footer');
            $table->unsignedInteger('order_column')->nullable();
            $table->boolean('is_active')->default(true)->comment('for active inactive menu');
            $table->string('url')->nullable();
            $table->boolean('is_checked')->default(false)->comment('is used for target blank');
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
        Schema::dropIfExists('media');
        Schema::dropIfExists('cms_seos');
        Schema::dropIfExists('cms_menus');
    }
}
