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
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable()->default(null);
            $table->string('address_1')->nullable()->default(null);
            $table->string('address_2')->nullable()->default(null);
            $table->string('city')->nullable()->default(null);
            $table->integer('country_id')->nullable()->default(null);
            $table->integer('zip')->nullable()->default(null);
            $table->string('phone')->nullable()->default(null);
            $table->string('fax')->nullable()->default(null);
            $table->string('email')->nullable()->default(null);
            $table->string('cin')->nullable()->default(null);
            $table->tinyInteger('status')->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};
