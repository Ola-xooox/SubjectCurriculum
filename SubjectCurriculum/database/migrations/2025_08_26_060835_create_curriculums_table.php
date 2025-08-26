<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('curriculums', function (Blueprint $table) {
            $table->id();
            $table->string('curriculum_name');
            $table->string('curriculum_code')->unique();
            $table->string('academic_year');
            $table->unsignedInteger('year_level'); // To store the highest year level (e.g., 2 or 4)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('curriculums');
    }
};