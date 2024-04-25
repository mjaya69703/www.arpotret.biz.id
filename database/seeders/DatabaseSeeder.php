<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        \App\Models\Admin::create([
            'name' => 'Admin Account',
            'email' => 'admin@gmail.com',
            'phone' => '089712345678',
            'username' => 'admin',
            'password' => Hash::make('admin123'),
            'is_verified' => true,
        ]);
        \App\Models\Admin::create([
            'name' => 'Fotografer Pemula',
            'email' => 'fotografer@gmail.com',
            'phone' => '081712345678',
            'username' => 'fotografer',
            'type' => 2,
            'password' => Hash::make('fotografer123'),
            'is_verified' => true,
        ]);
        \App\Models\Admin::create([
            'name' => 'Manager Pemula',
            'email' => 'manager@gmail.com',
            'phone' => '081712345671',
            'username' => 'manager',
            'type' => 0,
            'password' => Hash::make('manager123'),
            'is_verified' => true,
        ]);
        \App\Models\User::create([
            'name' => 'Member Account',
            'email' => 'member@gmail.com',
            'phone' => '089612345678',
            'username' => 'member',
            'password' => Hash::make('member1234'),
            'is_verified' => true,
        ]);
        \App\Models\WebSetting::create([
            'site_head' => 'Abadikan semua momen',
            'site_desc' => 'Menjelajahi dunia dalam satu frame.',
            'site_name' => 'ARPotRet',
            'site_team' => 'Muhamad Jaya Kusuma',
            'site_link' => 'https://newprojectfoto.dev/',

            'site_email' => 'mjaya69703@gmail.com',
            'site_phone' => '+6287848799145',

            'site_street' => 'Ciremai Raya Street',
            'site_poscod' => 'Harjamukti 45142, Cirebon',
            'site_locate' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d588.9835400660511!2d108.56216990473962!3d-6.746277803566846!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6f1d98bd2928fd%3A0xbabca397e836910a!2sRumah%20Sakit%20Siloam%20Putera%20Bahagia%20-%20Cirebon!5e0!3m2!1sen!2sid!4v1700910668494!5m2!1sen!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
        ]);
        // TYPE MENU
        \App\Models\PageManager::create([
            'id' => '1',
            'page_type' => '0',
            'page_name' => 'Main Menu',
            'page_link' => '#',
            'page_desc' => 'Daftar Menu Utama',
        ]);
        \App\Models\PageManager::create([
            'id' => '2',
            'page_type' => '0',
            'page_name' => 'Informasi Situs',
            'page_link' => '#',
            'page_desc' => 'Daftar Informasi Situs',
        ]);
        \App\Models\PageManager::create([
            'id' => '3',
            'page_type' => '0',
            'page_name' => 'Layanan Lainnya',
            'page_link' => '#',
            'page_desc' => 'Daftar Layanan Lainnya',
        ]);
        \App\Models\PageManager::create([
            'id' => '4',
            'page_type' => '0',
            'page_name' => 'Partner Kami',
            'page_link' => '#',
            'page_desc' => 'Daftar Partner Kami',
        ]);
        \App\Models\PageManager::create([
            'id' => '5',
            'page_type' => '0',
            'page_name' => 'Bantuan',
            'page_link' => '#',
            'page_desc' => 'Daftar Bantuan',
        ]);
        // DAFTAR MENU UTAMA
        \App\Models\PageManager::create([
            'page_id' => '1',
            'page_type' => '1',
            'page_name' => 'Beranda',
            'page_link' => '/',
            'page_desc' => 'Halaman utama kami',
        ]);
        \App\Models\PageManager::create([
            'page_id' => '1',
            'page_type' => '1',
            'page_name' => 'Mengapa Kami',
            'page_link' => '/#WhyUs',
            'page_desc' => 'Halaman mengapa kami?',
        ]);
        \App\Models\PageManager::create([
            'page_id' => '1',
            'page_type' => '1',
            'page_name' => 'Layanan Kami',
            'page_link' => '/#Services',
            'page_desc' => 'Halaman Layanan Kami',
        ]);
        \App\Models\PageManager::create([
            'page_id' => '1',
            'page_type' => '1',
            'page_name' => 'Produk',
            'page_link' => 'product',
            'page_desc' => 'Halaman Produk',
        ]);
        \App\Models\PageManager::create([
            'page_id' => '1',
            'page_type' => '1',
            'page_name' => 'Portfolio',
            'page_link' => 'portfolio',
            'page_desc' => 'Halaman Portfolio',
        ]);
        \App\Models\PageManager::create([
            'page_id' => '1',
            'page_type' => '1',
            'page_name' => 'Blog',
            'page_link' => 'blog',
            'page_desc' => 'Halaman Blog',
        ]);
        \App\Models\PageManager::create([
            'page_id' => '1',
            'page_type' => '1',
            'page_name' => 'Kontak Kami',
            'page_link' => 'contact-us',
            'page_desc' => 'Halaman Kontak Kami',
        ]);
        $now = \Carbon\Carbon::now();
        // GENERATE KATEGORI PRODUCT
        DB::table('product_categories')->insert([
            'id' => '1',
            'name' => 'Beautyshoot',
            'slug' => 'beautyshoot',
            'created_at' => $now,
            'author' => 'System',
        ]);
        DB::table('product_categories')->insert([
            'id' => '2',
            'name' => 'Couple & Prewedding',
            'slug' => 'couple-and-prewedding',
            'created_at' => $now,
            'author' => 'System',

        ]);
        DB::table('product_categories')->insert([
            'id' => '3',
            'name' => 'Family',
            'slug' => 'family',
            'created_at' => $now,
            'author' => 'System',

        ]);
        DB::table('product_categories')->insert([
            'id' => '4',
            'name' => 'Food & Product',
            'slug' => 'food-and-product',
            'created_at' => $now,
            'author' => 'System',

        ]);
        DB::table('product_categories')->insert([
            'id' => '5',
            'name' => 'Friend & Group',
            'slug' => 'friend-and-group',
            'created_at' => $now,
            'author' => 'System',

        ]);
        DB::table('product_categories')->insert([
            'id' => '6',
            'name' => 'Graduation',
            'slug' => 'graduation',
            'created_at' => $now,
            'author' => 'System',

        ]);
        DB::table('product_categories')->insert([
            'id' => '7',
            'name' => 'Hunting & Concept',
            'slug' => 'hunting-and-concept',
            'created_at' => $now,
            'author' => 'System',

        ]);
        DB::table('product_categories')->insert([
            'id' => '8',
            'name' => 'Kids & Birthday',
            'slug' => 'kids-and-birthday',
            'created_at' => $now,
            'author' => 'System',

        ]);
        DB::table('product_categories')->insert([
            'id' => '9',
            'name' => 'Maternity & Siraman',
            'slug' => 'maternity-and-siraman',
            'created_at' => $now,
            'author' => 'System',

        ]);
        DB::table('product_categories')->insert([
            'id' => '10',
            'name' => 'Walimatul Khitan & Rasul',
            'slug' => 'walimatul-khitan-and-rasul',
            'created_at' => $now,
            'author' => 'System',

        ]);
        DB::table('product_categories')->insert([
            'id' => '11',
            'name' => 'Wedding',
            'slug' => 'wedding',
            'created_at' => $now,
            'author' => 'System',

        ]);
        // DB::table('product_categories')->insert([
            // 'id' => '12',
            // 'name' => 'Engagement',
            // 'slug' => 'engagement',
            // 'created_at' => $now,
            // 'author' => 'System',
        // ]);
        // PRODUCT DEFAULT
        \App\Models\Product::create([
            'cproduct_id' => '1',
            'product_name' => 'Beautyshoot',
            'product_slug' => 'beautyshoot',
            'product_desc' => 'beautyshoot',
            'product_price' => '150000',
            'product_cover' => 'beautyshoot.jpg',
        ]);
        \App\Models\Product::create([
            'cproduct_id' => '2',
            'product_name' => 'Couple and Prewedding',
            'product_slug' => 'couple-and-prewedding',
            'product_desc' => 'couple-and-prewedding',
            'product_price' => '150000',
            'product_cover' => 'couple-and-prewedding.jpg',
        ]);
        \App\Models\Product::create([
            'cproduct_id' => '3',
            'product_name' => 'Family',
            'product_slug' => 'family',
            'product_desc' => 'family',
            'product_price' => '150000',
            'product_cover' => 'family.jpg',
        ]);
        \App\Models\Product::create([
            'cproduct_id' => '4',
            'product_name' => 'Food and Product',
            'product_slug' => 'food-and-product',
            'product_desc' => 'food-and-product',
            'product_price' => '150000',
            'product_cover' => 'food-and-product.jpg',
        ]);
        \App\Models\Product::create([
            'cproduct_id' => '5',
            'product_name' => 'Friend and Group',
            'product_slug' => 'friend-and-group',
            'product_desc' => 'friend-and-group',
            'product_price' => '150000',
            'product_cover' => 'friend-and-group.jpg',
        ]);
        \App\Models\Product::create([
            'cproduct_id' => '6',
            'product_name' => 'Graduation',
            'product_slug' => 'graduation',
            'product_desc' => 'graduation',
            'product_price' => '150000',
            'product_cover' => 'graduation.jpg',
        ]);
        \App\Models\Product::create([
            'cproduct_id' => '7',
            'product_name' => 'Hunting and Concept',
            'product_slug' => 'hunting-and-concept',
            'product_desc' => 'hunting-and-concept',
            'product_price' => '150000',
            'product_cover' => 'hunting-and-concept.jpg',
        ]);
        \App\Models\Product::create([
            'cproduct_id' => '8',
            'product_name' => 'Kids and Birthday',
            'product_slug' => 'kids-and-birthday',
            'product_desc' => 'kids-and-birthday',
            'product_price' => '150000',
            'product_cover' => 'kids-and-birthday.jpg',
        ]);
        \App\Models\Product::create([
            'cproduct_id' => '9',
            'product_name' => 'Maternity and Siraman',
            'product_slug' => 'maternity-and-siraman',
            'product_desc' => 'maternity-and-siraman',
            'product_price' => '150000',
            'product_cover' => 'maternity-and-siraman.jpg',
        ]);
        \App\Models\Product::create([
            'cproduct_id' => '10',
            'product_name' => 'Walimatul Khitan and Rasul',
            'product_slug' => 'walimatul-khitan-and-rasul',
            'product_desc' => 'walimatul-khitan-and-rasul',
            'product_price' => '150000',
            'product_cover' => 'walimatul-khitan-and-rasul.jpg',
        ]);
        \App\Models\Product::create([
            'cproduct_id' => '11',
            'product_name' => 'Wedding',
            'product_slug' => 'wedding',
            'product_desc' => 'wedding',
            'product_price' => '150000',
            'product_cover' => 'wedding.jpg',
        ]);
        // \App\Models\Product::create([
            // 'cproduct_id' => '12',
            // 'product_name' => 'Engagement',
            // 'product_slug' => 'engagement',
            // 'product_desc' => 'engagement',
            // 'product_price' => '150000',
            // 'product_cover' => 'engagement.jpg',
        // ]);


    }
}
