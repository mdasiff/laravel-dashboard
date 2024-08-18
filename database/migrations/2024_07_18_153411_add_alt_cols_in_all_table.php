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
        Schema::table('industries', function (Blueprint $table) {
            $table->string('image_alt')->after('image')->nullable()->default(null);
        });

        Schema::table('industry_categories', function (Blueprint $table) {
            $table->string('image_alt')->after('image')->nullable()->default(null);
        });

        Schema::table('resources', function (Blueprint $table) {
            $table->string('image_alt')->after('image')->nullable()->default(null);
        });

        Schema::table('resource_categories', function (Blueprint $table) {
            $table->string('image_alt')->after('image')->nullable()->default(null);
        });

        Schema::table('services', function (Blueprint $table) {
            $table->string('image_alt')->after('image')->nullable()->default(null);
        });

        Schema::table('service_categories', function (Blueprint $table) {
            $table->string('image_alt')->after('image')->nullable()->default(null);
        });

        Schema::table('solutions', function (Blueprint $table) {
            $table->string('image_alt')->after('image')->nullable()->default(null);
        });

        Schema::table('solution_categories', function (Blueprint $table) {
            $table->string('image_alt')->after('image')->nullable()->default(null);
        });

        Schema::table('speakers', function (Blueprint $table) {
            $table->string('image_alt')->after('image')->nullable()->default(null);
        });

        Schema::table('testimonials', function (Blueprint $table) {
            $table->string('image_alt')->after('image')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('all', function (Blueprint $table) {
            //
        });
    }
};
