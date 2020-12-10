<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('noted', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->BigInteger('nis')->nullable();
            $table->foreign('nis')->references('NIS')->on('siswa')->onDelete('cascade');
            $table->BigInteger('nip')->nullable();
            $table->foreign('nip')->references('NIP')->on('guru')->onDelete('cascade');
            $table->string('nama')->nullable();
            $table->string('judul');
            $table->string('pengarang');
            $table->string('deskripsi', 255)->nullable();
            $table->date('tanggal_usulan');
            $table->string('status');
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
        Schema::dropIfExists('noted');
    }
}
