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
            $table->integer('id')->autoIncrement()->unsigned();
            $table->string('id_number');
            $table->string('name');
            $table->string('user_name')->unique();
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('password');
            $table->string('token_reset_password')->nullable();
            $table->string('token')->nullable();
            $table->tinyInteger('gender');
            $table->string('city');
            $table->string('image')->default('default.png');
            $table->tinyInteger('group_id');
            $table->integer('bank_id')->unsigned();
            $table->timestamps();
            // $table->foreign('bank_id')->references('id')->on('bemo_banks')->onDelete('cascade');
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
