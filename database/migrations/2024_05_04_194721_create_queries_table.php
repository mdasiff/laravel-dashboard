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
        Schema::create('queries', function (Blueprint $table) {
            $table->id();
            $table->string('fname')->nullable()->default(null);
            $table->string('lname')->nullable()->default(null);
            $table->integer('phone')->nullable()->default(null);
            $table->string('email')->nullable()->default(null);
            $table->string('job_title')->nullable()->default(null);
            $table->string('company')->nullable()->default(null);
            $table->string('country')->nullable()->default(null);
            $table->text('message')->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('queries');
    }
};
