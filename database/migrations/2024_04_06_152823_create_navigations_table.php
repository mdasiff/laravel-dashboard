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
        Schema::create('navigations', function (Blueprint $table) {
            $table->id();
            $table->integer('parent_id')->nullable()->default(0);
            $table->integer('main_menu_id')->nullable()->default(0);
            $table->string('name')->nullable()->default(null);
            $table->string('type')->nullable()->default(null);
            $table->string('link')->nullable()->default(null);
            $table->string('file')->nullable()->default(null);
            $table->tinyInteger('status')->nullable()->default(true);
            $table->integer('sort')->nullable()->default(0);
            $table->integer('level')->nullable()->default(0);
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
        Schema::dropIfExists('navigations');
    }
};
