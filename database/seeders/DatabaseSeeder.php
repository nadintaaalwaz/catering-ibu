<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Menu;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Akun admin (ganti password nanti!)
        User::updateOrCreate(
            ['email' => 'admin@dapuribu.test'],
            ['name' => 'Admin', 'password' => Hash::make('password123')]
        );

        // Info usaha
        Setting::firstOrCreate(['id' => 1], [
            'business_name' => 'Dapur Ibu',
            'whatsapp_number' => '6285875206802',
            'address' => 'Kediri, Jawa Timur',
            'opening_hours' => 'Senin - Sabtu, 07.00 - 17.00',
            'about' => 'Menerima pesanan kue dan nasi kotak untuk berbagai acara.',
        ]);

        // Kategori
        $kue = Category::firstOrCreate(['slug' => 'kue'], ['name' => 'Kue', 'sort_order' => 1]);
        $nasi = Category::firstOrCreate(['slug' => 'nasi-kotak'], ['name' => 'Nasi Kotak', 'sort_order' => 2]);

        // Menu contoh
        $menus = [
            [$kue->id, 'Bolu Pandan', 'bolu-pandan', 'Bolu pandan lembut, ukuran 20 cm.', 65000, 1, true],
            [$kue->id, 'Brownies Coklat', 'brownies-coklat', 'Brownies panggang tebal, ukuran 20 cm.', 75000, 1, false],
            [$nasi->id, 'Nasi Kotak Paket A', 'nasi-kotak-paket-a', 'Nasi, ayam goreng, sambal, lalapan, kerupuk.', 25000, 20, true],
            [$nasi->id, 'Nasi Kotak Paket B', 'nasi-kotak-paket-b', 'Nasi, ayam bakar, urap, tempe, kerupuk.', 28000, 20, false],
        ];

        foreach ($menus as [$catId, $name, $slug, $desc, $price, $min, $featured]) {
            Menu::updateOrCreate(['slug' => $slug], [
                'category_id' => $catId,
                'name' => $name,
                'description' => $desc,
                'price' => $price,
                'min_order' => $min,
                'is_featured' => $featured,
            ]);
        }
    }
}