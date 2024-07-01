<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomUsersTable extends Migration
{
    public function up()
    {
        Schema::create('custom_users', function (Blueprint $table) {
            $table->id();
            $table->string('login')->unique();
            $table->string('password');
// Добавьте другие поля, если необходимо
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('custom_users');
    }
}
