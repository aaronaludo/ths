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
        Schema::create('gallery_showcase_contents', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();
            $table->string('sub_title')->nullable();
            $table->string('title');
            $table->string('description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gallery_showcase_contents');
    }
};
