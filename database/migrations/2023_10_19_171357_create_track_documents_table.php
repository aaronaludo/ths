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
        Schema::create('track_documents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('qr_code');
            $table->string('subject');
            $table->string('description');
            $table->string('prioritization');
            $table->timestamp('document_created_date');
            $table->string('classification');
            $table->string('reference');
            $table->string('attachment');
            $table->string('attachment_description');
            $table->integer('archive');
            $table->timestamps();
            
            // Define foreign key relationships
            // $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('track_documents');
    }
};
