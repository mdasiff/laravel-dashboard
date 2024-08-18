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
        Schema::create('resource_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('slug');
            $table->string('image')->nullable();
            $table->integer('sort')->default(0);
            $table->boolean('status')->default(0);

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
        Schema::dropIfExists('resource_categories');
    }
};
