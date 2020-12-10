<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class BukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            // ['A05','Matematika Diskrit', 6, 6,'Rinaldi Munir', 'Informatika Bandung',2016,'978-602-6232-13-7',10,NULL],
        ];
        for ($i = 0; $i < count($data); $i++) {
            $kode_buku = $data[$i][0];
            $judul = $data[$i][1];
            $kategori = $data[$i][2];
            $edisi = $data[$i][3];
            $penulis = $data[$i][4];
            $penerbit = $data[$i][5];
            $tahun_terbit = $data[$i][6];
            $ISBN = $data[$i][7];
            $jumlah = $data[$i][8];
            $cover = $data[$i][9];

        DB::table('buku')->insert([
            'kode_buku' =>  $kode_buku,
            'judul_buku' =>  $judul,
            'kategori_id' => $kategori,
            'edisi' => $edisi,
            'penulis' => $penulis,
            'penerbit' =>  $penerbit,
            'tahun_terbit' =>  $tahun_terbit,
            'ISBN' => $ISBN,
            'jumlah' =>  $jumlah,
            'cover' =>  $cover,
           
            ]);
        }
    }
}
