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
        Schema::create('online_jobs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('father_name');
            $table->string('mother_name');
            $table->date('date_of_birth');
            $table->tinyInteger('gender')->comment('1 = Male, 2 = Female');
            $table->tinyInteger('martial_status')->comment('1 = Single, 2 = Married, 3 = Divorced, 4 = Widowed');
            $table->string('national_id')->unique();
            $table->string('religion_status');
            $table->text('present_address');
            $table->text('permanent_address');
            $table->string('email')->unique();
            $table->string('mobile')->unique();
            $table->string('photo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('online_jobs');
    }
};
