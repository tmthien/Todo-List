<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123123123'),
            'phone'=> '0898236426',
            'address' => 'Đà Nẵng',
            'role' => UserRole::Admin,
        ]);
    }
}
