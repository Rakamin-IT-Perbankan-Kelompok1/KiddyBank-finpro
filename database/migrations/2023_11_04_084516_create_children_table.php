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
        Schema::create('child', function (Blueprint $table) {
            $table->id();
            $table->string('id_user');
            $table->string('child_username');
            $table->string('child_fullname');
            $table->string('email')->unique();     
            $table->string('telephone')->nullable();;
            $table->text('address')->nullable();;
            $table->string('password');
            $table->string('otp')->nullable();
            $table->enum('activated', [0, 1])->default(0);
            $table->timestamp('expired_otp');
            $table->rememberToken();
            $table->timestamps();
        });

        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('children');
    }
};
