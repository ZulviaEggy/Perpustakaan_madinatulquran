<?php

use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['Umum','1'],
            ['Filsafat dan Psikologi','2'],
            ['Agama','3'],
            ['Sosial','4'],
            ['Bahasa','5'],
            ['Sains dan Matematika','6'],
            ['Teknologi','7'],
            ['Seni dan Rekreasi','8'],
            ['Literatur dan Sastra','9'],
            ['Sejarah dan Geografi','10'],
        ];
        for ($i = 0; $i < count($data); $i++) {
            $kategori = $data[$i][0];
            $rak = $data[$i][1];
        DB::table('kategori_buku')->insert([
            'nama_kategori' =>  $kategori,
            'rak' =>  $rak,
            ]);
    }
}
}
