<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Elektronik',
            'Aksesori Gadget',
            'Perlengkapan Rumah',
            'Kebutuhan Bayi',
            'Kesehatan & Kecantikan',
            'Alat Tulis & Kantor',
        ];

        foreach ($categories as $name) {
            $slug = Str::slug($name);
            Category::updateOrCreate(
                ['slug' => $slug],
                ['name' => $name, 'active' => true]
            );
        }
    }
}
