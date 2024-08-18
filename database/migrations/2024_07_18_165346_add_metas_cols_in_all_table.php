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
        Schema::table('testimonials', function (Blueprint $table) {
            $table->enum('type', ['text', 'video'])->after('name')->nullable()->default(null);
            $table->string('video')->nullable()->default(null);
            $table->string('meta_tag_title')->nullable()->default(null);
            $table->string('meta_tag_keywords')->nullable()->default(null);
            $table->longText('meta_tag_description')->nullable()->default(null);
        });

        Schema::table('services', function (Blueprint $table) {
            $table->string('meta_tag_title')->nullable()->default(null);
            $table->string('meta_tag_keywords')->nullable()->default(null);
            $table->longText('meta_tag_description')->nullable()->default(null);
        });

        Schema::table('solutions', function (Blueprint $table) {
            $table->string('meta_tag_title')->nullable()->default(null);
            $table->string('meta_tag_keywords')->nullable()->default(null);
            $table->longText('meta_tag_description')->nullable()->default(null);
        });

        Schema::table('industries', function (Blueprint $table) {
            $table->string('meta_tag_title')->nullable()->default(null);
            $table->string('meta_tag_keywords')->nullable()->default(null);
            $table->longText('meta_tag_description')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        
    }
};
