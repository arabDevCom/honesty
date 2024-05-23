<?php

namespace Database\Seeders;

use App\Models\Manager;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Manager::query()->create([
            'name' => 'amo',
            'email' => 'amo@gmail.com',
            'phone' => '+96650000000',
            'password' => 'amo@gmail.com'
        ]);
    }
}
