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
        Schema::drop('competence_users');
        Schema::drop('mission_technologies');
        Schema::drop('technologies_users');
        Schema::drop('categories');
        Schema::drop('technologies');
        Schema::drop('competences');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
