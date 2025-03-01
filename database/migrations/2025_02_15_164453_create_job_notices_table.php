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
        Schema::create('job_notices', function (Blueprint $table) {
            $table->id();
            $table->string('title');          // Job Notice Title
            $table->text('description');      // Job Notice Description
            $table->string('slug')->unique(); // Slug for URL friendly format
            $table->enum('status', ['active', 'inactive'])->default('active'); // Job status
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_notices');
    }
};
