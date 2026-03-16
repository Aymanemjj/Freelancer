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
            $table->dropColumn('name');
            $table->string('firstname');
            $table->string('lastname');
            $table->boolean('active')->default(true);
            $table->string('role');
            $table->float('price');
            $table->string('portfolio_link')->nullable();
            $table->string('availability')->default('Any time');
            $table->float('rating')->default(0);
            $table->string('enterprise')->nullable();
            $table->string('description')->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
