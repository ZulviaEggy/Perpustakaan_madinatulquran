<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeminjamanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kode_pinjam');
            $table->BigInteger('nis')->nullable();
            $table->foreign('nis')->references('NIS')->on('siswa')->onDelete('cascade');    
            $table->BigInteger('nip')->nullable();
            $table->foreign('nip')->references('NIP')->on('guru')->onDelete('cascade');
            $table->string('buku_id');
            $table->unsignedBigInteger('status_id');
            $table->foreign('status_id')->references('id')->on('status')->onDelete('cascade');
            $table->date('tanggal_peminjaman');
            $table->date('tanggal_harus_kembali');
            $table->string('keterlambatan')->nullable();
            $table->decimal('denda')->nullable();
            $table->string('kondisi_buku')->nullable();
            $table->decimal('denda_buku')->nullable();
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
        Schema::dropIfExists('peminjaman');
    }
}
