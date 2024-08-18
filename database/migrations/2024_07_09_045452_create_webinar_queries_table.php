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
        Schema::create('webinar_queries', function (Blueprint $table) {
            $table->id();
            $table->integer('webinar_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('contact');
            $table->string('company');
            $table->string('job_title');
            $table->string('country');
            $table->longText('message')->nullable();
            $table->boolean('notified')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('webinar_queries');
    }
};
