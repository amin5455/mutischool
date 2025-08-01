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
        Schema::create('timetables', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('school_id');
        $table->unsignedBigInteger('class_id');
        $table->unsignedBigInteger('subject_id');
        $table->unsignedBigInteger('teacher_id');
        $table->string('weekday'); // e.g., Monday, Tuesday
        $table->time('start_time');
        $table->time('end_time');
        $table->timestamps();

        $table->foreign('school_id')->references('id')->on('schools')->onDelete('cascade');
        $table->foreign('class_id')->references('id')->on('school_classes')->onDelete('cascade');
        $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
        $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('timetables');
    }
};
