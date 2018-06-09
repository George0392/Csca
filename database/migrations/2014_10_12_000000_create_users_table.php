<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('nombre');
            $table->string('username',15)->unique();
            $table->Integer('profesor_id')->unsigned();
            $table->Integer('servicio_id')->unsigned();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('direccion');
            $table->date('inicio');
            $table->date('nacimiento');
            $table->integer('dni');
            $table->integer('edad');
            $table->string('peso');
            $table->integer('altura');
            $table->string('type')->default('default');
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
