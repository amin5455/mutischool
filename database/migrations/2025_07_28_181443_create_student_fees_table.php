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
        Schema::create('student_fees', function (Blueprint $table) {
              $table->id();
              $table->unsignedBigInteger('student_id');
              $table->unsignedBigInteger('fee_type_id');
              $table->decimal('amount_paid', 8, 2);
              $table->date('payment_date');
              $table->string('payment_mode')->nullable(); // e.g. cash, bank
              $table->text('note')->nullable();
              $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_fees');
    }
};
