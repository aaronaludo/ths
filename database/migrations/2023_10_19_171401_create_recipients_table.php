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
        Schema::create('recipients', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('track_document_id');
            $table->unsignedBigInteger('role_id');
            $table->unsignedBigInteger('status_id');
            $table->timestamp('status_date');
            
            // Define foreign key relationships
            // $table->foreign('track_document_id')->references('id')->on('track_documents');
            // $table->foreign('role_id')->references('id')->on('roles');
            // $table->foreign('status_id')->references('id')->on('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipients');
    }
};
