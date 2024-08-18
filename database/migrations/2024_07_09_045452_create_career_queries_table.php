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
        Schema::create('career_queries', function (Blueprint $table) {
            $table->id();
            $table->string('file')->nullable();
            $table->string('name');
            $table->string('email');
            $table->string('contact');
            $table->string('position');
            $table->string('relative');
            $table->string('dob');
            $table->string('location');
            $table->boolean('notified')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('career_queries');
    }
};
