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
<<<<<<< HEAD
            $table->bigIncrements('id');
            $table->string('Nid');
            $table->string('name');
            $table->string('email');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('gender', ['male', 'female']);
            $table->date('birth_date');
            $table->string('avatar');
            $table->enum('roles', ['admin', 'teacher','supporter','student']);
            $table->string('verify_token')->nullable();
            $table->tinyInteger('verify')->default(0);
            $table->date('last_login')->nullable();
=======
            $table->string('Nid')->unique();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('avatar');
            $table->enum('roles', ['admin','teacher', 'supporter']);	
            $table->enum('gender', ['male', 'female']);	
>>>>>>> 478984a18f64a3445e593c70eb4aabdde72586aa
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
