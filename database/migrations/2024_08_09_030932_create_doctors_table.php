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
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Foreign key to users table

            // Certificate as a photo (path to the file)
            $table->string('certificate')->nullable(); // Store the file path

            // Additional fields
            $table->integer('experience')->nullable(); // Years of experience
            $table->text('description')->nullable(); // Description or bio of the doctor
            $table->string('specialization')->nullable(); // Area of specialization
            $table->string('location')->nullable(); // Location of practice
            $table->softDeletes();

            // Approval status
            $table->boolean('is_approved')->default(false);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
