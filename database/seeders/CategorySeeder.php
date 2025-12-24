<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Admin;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        // Get admin (creator)
        $admin = Admin::where('name', 'admin')->first();

        if (!$admin) {
            $this->command->error('Admin not found. Run AdminSeeder first.');
            return;
        }

        $categories = [
            'PHP',
            'Laravel',
            'JavaScript',
            'MySQL',
            'HTML & CSS',
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['name' => $category],
                ['creator_id' => $admin->id]
            );
        }
    }
}
