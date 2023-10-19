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
        Schema::create('bankAccount', function (Blueprint $table) {
            $table->id();
            $table->string('account_number');
            $table->decimal('balance', 10, 2)->default(0.00);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bankAccount', function (Blueprint $table) {
            $table->dropColumn('balance');
        });
    }
};