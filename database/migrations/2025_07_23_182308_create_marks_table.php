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
        Schema::create('marks', function (Blueprint $table) {
         $table->id();
         $table->unsignedBigInteger('exam_id');
         $table->unsignedBigInteger('class_id');
         $table->unsignedBigInteger('section_id');
         $table->unsignedBigInteger('subject_id');
         $table->unsignedBigInteger('student_id');
         $table->float('marks_obtained');
         $table->timestamps();
     
         $table->foreign('exam_id')->references('id')->on('exams')->onDelete('cascade');
         $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('marks');
    }
};
