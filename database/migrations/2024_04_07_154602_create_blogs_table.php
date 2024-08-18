<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->integer('blog_category_id')->default(null)->nullable();
            $table->string('title')->unique()->default(null);
            $table->string('image')->nullable()->default(null);
            $table->string('sub_title')->nullable()->default(null);
            $table->string('slug')->nullable()->default(null);
            $table->string('highlight_keywords')->nullable()->default(null);
            $table->boolean('status')->default(0)->nullable();

            //seo
            $table->string('meta_tag_title')->nullable()->default(null);
            $table->string('meta_tag_keywords')->nullable()->default(null);
            $table->text('meta_tag_description')->nullable()->default(null);
            $table->integer('views')->default(0)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
