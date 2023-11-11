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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('id_bankaccount');
            $table->string('acountNumber', 20);
            $table->decimal('amount', 10, 2);
            $table->string('recipientAccount', 20);
            $table->string('senderName');
            $table->string('recepientName');
            $table->string('senderType');
            $table->string('transaction_status', 20);
            $table->timestamp('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
