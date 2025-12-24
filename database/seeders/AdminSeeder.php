<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        Admin::updateOrCreate(
            ['name' => 'admin'], // unique key
            ['password' => Hash::make('admin@123')]
        );

        Admin::updateOrCreate(
            ['name' => 'superadmin'],
            ['password' => Hash::make('super@123')]
        );
    }
}