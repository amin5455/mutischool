<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
     public function up()
    {
        Schema::table('attendances', function (Blueprint $table) {
            $table->dropColumn('status');
        });
        
        Schema::table('attendances', function (Blueprint $table) {
            $table->enum('status', ['present', 'absent', 'leave'])->default('present');
        });
    }

    public function down()
    {
        Schema::table('attendances', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        Schema::table('attendances', function (Blueprint $table) {
            $table->enum('status', ['present', 'absent'])->default('present');
        });
    }

};
