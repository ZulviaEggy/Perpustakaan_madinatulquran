<?php

use Illuminate\Database\Seeder;

class JenjangPendidikanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['SD Tahfidz'],
            ['SMP Islam'],
            ['SMA Tahfidz'],
            ['P-TB'],
            ['MA'],

        ];
        for ($i = 0; $i < count($data); $i++) {
            $jenjang_pendidikan = $data[$i][0];
        DB::table('jenjang_pendidikan')->insert([
            'jenjang_pendidikan' =>  $jenjang_pendidikan,
            ]);
        }
    }
}
