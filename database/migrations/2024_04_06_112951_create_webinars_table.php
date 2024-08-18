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
        Schema::create('webinars', function (Blueprint $table) {
            $table->id();
            $table->integer('speaker_id')->nullable()->default(null);
            $table->string('title')->nullable()->default(null);
            $table->string('industry')->nullable()->default(null);
            $table->timestamp('webinar_date');
            $table->string('timezone_id')->nullable()->default(null);
            $table->string('global_zone')->nullable()->default(null);
            $table->text('synopsis')->nullable()->default(null);
            $table->boolean('status')->default(1);
            $table->string('meta_tag_title')->nullable()->default(null);
            $table->string('meta_tag_keywords')->nullable()->default(null);
            $table->text('meta_tag_description')->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('webinars');
    }
};
