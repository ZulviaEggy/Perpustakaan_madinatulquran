<?php

use Illuminate\Database\Seeder;

class GenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
        $data = [
            ['famale'],
            ['male'],
        ];
        for ($i = 0; $i < count($data); $i++) {
            $genders = $data[$i][0];

        DB::table('genders')->insert([
            'gender' =>  $genders,
          
            ]);
        }
    }
}
