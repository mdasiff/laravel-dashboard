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
        Schema::table('webinars', function (Blueprint $table) {
            //$table->string('slug')->after('title')->nullable()->default(null);
            //$table->string('global_zone')->after('timezone_id')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('webinar', function (Blueprint $table) {
            //
        });
    }
};
