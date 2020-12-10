<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersPrivilegeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_privilege', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('privilege_level');
        });

        DB::table('users_privilege')->insert([
            [
                'id'       => '1',
                'privilege_level'      => 'super administrator',
            ],
            [
                'id'       => '2',
                'privilege_level'      => 'admin anggota',
            ],
            [
                'id'       => '3',
                'privilege_level'      => 'admin transaksi',
            ],
            [
                'id'       => '4',
                'privilege_level'      => 'admin buku',
            ],
            [
                'id'       => '5',
                'privilege_level'      => 'siswa',
            ],
            [
                'id'       => '6',
                'privilege_level'      => 'guru',
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_privilege');
    }
}
