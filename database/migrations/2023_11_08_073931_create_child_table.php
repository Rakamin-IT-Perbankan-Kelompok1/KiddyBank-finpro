<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChildTable extends Migration
{
    public function up()
    {
        Schema::create('child', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user'); // Assuming a foreign key relationship with the parent user
            $table->string('username')->unique();
            $table->string('fullname');
            $table->string('email')->unique();
            $table->string('telephone');
            $table->string('address');
            $table->string('password');
            $table->timestamp('expired_otp');
            $table->timestamps();

            // Define the foreign key relationship with the parent user
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('child');
    }
}
