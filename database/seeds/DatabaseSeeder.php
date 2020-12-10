<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
        StatusSeeder::class,
        UsersTableSeeder::class,
        GenderSeeder::class,
        KategoriSeeder::class,
        BukuSeeder::class,
        JenjangPendidikanSeeder::class,
        SekolahSeeder::class,
        ]);
    }
}
