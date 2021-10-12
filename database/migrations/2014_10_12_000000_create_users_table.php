<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable()->length(20);
            $table->string('email')->length(20)->nullable();
            // $table->timestamp('email_verified_at')->nullable();
            $table->string('phone')->unique()->length(12);
            $table->integer('otp')->length(4);
            $table->string('address')->nullable()->length(50);
            $table->string('status')->length(10);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
