<?php

use Illuminate\Database\Seeder;

class SekolahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['Sistem Informasi Perpustakaan'],
        ];
        for ($i = 0; $i < count($data); $i++) {
            $deskripsi = $data[$i][0];

        DB::table('nama_sekolah')->insert([
            'deskripsi' =>  $deskripsi,
           
            ]);
        }
    }
}
