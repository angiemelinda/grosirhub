<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $bySlug = fn(string $slug) => Category::where('slug', $slug)->first()?->id;

        $products = [
            // Elektronik
            ['sku' => 'ELX-EBX2-001', 'name' => 'Earbuds X2', 'category_slug' => 'elektronik', 'price' => 125000, 'stock' => 320, 'status' => 'active'],
            ['sku' => 'ELX-AD20-002', 'name' => 'Adaptor 20W', 'category_slug' => 'elektronik', 'price' => 68000, 'stock' => 210, 'status' => 'active'],
            // Aksesori Gadget
            ['sku' => 'ACC-CBL-C100', 'name' => 'Kabel Data Type-C (1m)', 'category_slug' => 'aksesori-gadget', 'price' => 18000, 'stock' => 960, 'status' => 'active'],
            ['sku' => 'ACC-SPG-010', 'name' => 'Tempered Glass Full Glue', 'category_slug' => 'aksesori-gadget', 'price' => 12000, 'stock' => 540, 'status' => 'active'],
            // Perlengkapan Rumah
            ['sku' => 'HOME-MOP-003', 'name' => 'Set Pel Lantai Spin', 'category_slug' => 'perlengkapan-rumah', 'price' => 98000, 'stock' => 120, 'status' => 'active'],
            ['sku' => 'HOME-STW-004', 'name' => 'Set Wadah Makanan 10pcs', 'category_slug' => 'perlengkapan-rumah', 'price' => 55000, 'stock' => 280, 'status' => 'active'],
            // Kebutuhan Bayi
            ['sku' => 'BABY-DLP-005', 'name' => 'Diapers L 20pcs', 'category_slug' => 'kebutuhan-bayi', 'price' => 52000, 'stock' => 400, 'status' => 'active'],
            ['sku' => 'BABY-BTL-006', 'name' => 'Botol Susu Anti Kolik', 'category_slug' => 'kebutuhan-bayi', 'price' => 36000, 'stock' => 180, 'status' => 'active'],
            // Kesehatan & Kecantikan
            ['sku' => 'BEAU-SERUM-007', 'name' => 'Serum Vitamin C 20ml', 'category_slug' => 'kesehatan-kecantikan', 'price' => 89000, 'stock' => 95, 'status' => 'active'],
            ['sku' => 'BEAU-MSK-008', 'name' => 'Masker Wajah 10pcs', 'category_slug' => 'kesehatan-kecantikan', 'price' => 27000, 'stock' => 260, 'status' => 'active'],
            // Alat Tulis & Kantor
            ['sku' => 'OFF-NBK-A5-009', 'name' => 'Notebook A5 100 Hal', 'category_slug' => 'alat-tulis-kantor', 'price' => 15000, 'stock' => 600, 'status' => 'active'],
            ['sku' => 'OFF-PEN-010', 'name' => 'Pulpen Gel 0.5mm (12pcs)', 'category_slug' => 'alat-tulis-kantor', 'price' => 24000, 'stock' => 450, 'status' => 'active'],
        ];

        foreach ($products as $p) {
            $categoryId = $bySlug($p['category_slug']);
            Product::updateOrCreate(
                ['sku' => $p['sku']],
                [
                    'name' => $p['name'],
                    'category_id' => $categoryId,
                    'price' => $p['price'],
                    'stock' => $p['stock'],
                    'status' => $p['status'],
                ]
            );
        }
    }
}
