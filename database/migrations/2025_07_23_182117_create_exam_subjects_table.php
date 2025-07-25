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
        Schema::create('exam_subjects', function (Blueprint $table) {
            
         $table->id();
         $table->unsignedBigInteger('exam_id');
         $table->unsignedBigInteger('school_class_id');
         $table->unsignedBigInteger('subject_id');
         $table->unsignedBigInteger('teacher_id')->nullable(); // Optional
         $table->integer('total_marks');
         $table->timestamps();
    
         $table->foreign('exam_id')->references('id')->on('exams')->onDelete('cascade');
         $table->foreign('school_class_id')->references('id')->on('school_classes')->onDelete('cascade');
         $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_subjects');
    }
};
