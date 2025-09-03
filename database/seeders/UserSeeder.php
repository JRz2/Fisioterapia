<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::Create([
            'name' => 'Johnny Apaza Prado',
            'email'=> 'japaza@fisiomedep.com',
            'password' => bcrypt('japaza@fisiomedep.com')
        ])->assignRole('Admin');
    }
}
