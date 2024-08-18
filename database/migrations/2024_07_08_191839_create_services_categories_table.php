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
        Schema::create('service_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description')->nullable()->default(null);
            $table->string('slug')->nullable()->default(null);;
            $table->string('image')->nullable()->default(null);
            $table->integer('sort')->nullable()->default(0);
            $table->boolean('status')->nullable()->default(0);

            $table->string('meta_tag_title')->nullable()->default(null);
            $table->string('meta_tag_keywords')->nullable()->default(null);
            $table->longText('meta_tag_description')->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services_categories');
    }
};
