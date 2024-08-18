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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('product_category_id');
            $table->string('name');
            $table->string('slug');
            $table->string('image')->nullable();
            $table->longText('description')->nullable();
            $table->boolean('status')->default(1);
            $table->integer('sort')->default(0);

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
        Schema::dropIfExists('products');
    }
};
