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
            $table->bigIncrements('id');   
            $table->string('email')->unique()->nullable(); 
            $table->BigInteger('staff_id')->nullable();
            $table->BigInteger('nip')->nullable();
            $table->BigInteger('nis')->nullable();
            $table->string('password');  
            $table->string('role_id');
            $table->string('nama')->nullable();
            $table->string('photo')->nullable();
            $table->string('alamat')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->enum('gender',['P','L'])->nullable();
            $table->string('profesi')->nullable();
            $table->string('phone')->nullable();
			$table->dateTime('last_login_at')->nullable();
			$table->timestamp('deleted_at');
            $table->timestamp('email_verified_at')->nullable();
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
