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
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('tag')->nullable();
            $table->string('slug')->unique();
            $table->string('image');
            $table->string('image_alt');
            $table->longText('short_description');
            $table->longText('description');
            $table->boolean('status');
            $table->boolean('sort');

            $table->string('meta_tag_title')->nullable();
            $table->string('meta_tag_keywords')->nullable();
            $table->longText('meta_tag_description')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
