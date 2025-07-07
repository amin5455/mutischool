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
        Schema::table('users', function (Blueprint $table) {
        $table->enum('role', ['admin', 'teacher', 'student'])->default('admin');
        $table->foreignId('school_id')->nullable()->constrained()->onDelete('cascade');
});

        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
        $table->dropColumn('role');
        $table->dropForeign(['school_id']);
        $table->dropColumn('school_id');
        });
    }
};
