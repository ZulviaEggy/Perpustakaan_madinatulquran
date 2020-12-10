<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use App\User;
use App\Models\RoleHierarchy;


class StatusSeeder extends Seeder
{
   
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
    $statusIds = array();
    $faker = Faker::create();

     /*  insert status  */
     DB::table('status')->insert([
        'name' => 'Diperpanjang',
        'class' => 'badge badge-pill badge-primary',
    ]);
    array_push($statusIds, DB::getPdo()->lastInsertId());
    DB::table('status')->insert([ 
        'name' => 'Dikembalikan',
        'class' => 'badge badge-pill badge-secondary',
    ]);
    array_push($statusIds, DB::getPdo()->lastInsertId());
    DB::table('status')->insert([
        'name' => 'Dipinjam',
        'class' => 'badge badge-pill badge-success',
    ]);
    
    array_push($statusIds, DB::getPdo()->lastInsertId());
    }
}
