<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServicesSeeder extends Seeder
{
    public function run()
    {
        $services = [
            [
                'name'        => 'Signboard',
                'slug'       => 'signboard',
                'description' => 'High-quality signage solutions that make your brand visible and memorable across all locations.',
                'icon'        => 'bi bi-signpost',
                'order'       => 1,
                'is_active'   => true,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'name'        => 'Furniture & Interior Design',
                'slug'       => 'furniture-interior-design',
                'description' => 'Custom furniture and decoration services to create inspiring spaces for your business and events.',
                'icon'        => 'bi bi-house-door',
                'order'       => 2,
                'is_active'   => true,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'name'        => 'Branding & Digital Printing',
                'slug'       => 'branding-digital-printing',
                'description' => 'Creative branding and advanced printing solutions that bring your ideas to life with precision.',
                'icon'        => 'bi bi-brush',
                'order'       => 3,
                'is_active'   => true,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'name'        => 'Booths & Kiosks',
                'slug'       => 'booths-kiosks',
                'description' => 'Design and construction of booths and kiosks that attract attention and engage your audience.',
                'icon'        => 'bi bi-shop',
                'order'       => 4,
                'is_active'   => true,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'name'        => 'Stands & Gondolas',
                'slug'       => 'stands-gondolas',
                'description' => 'Functional and stylish stands that showcase your products effectively in exhibitions and retail spaces.',
                'icon'        => 'bi bi-display',
                'order'       => 5,
                'is_active'   => true,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'name'        => 'Creative Consultancy',
                'slug'       => 'creative-consultancy',
                'description' => 'Expert guidance to transform your vision into impactful campaigns and memorable customer experiences.',
                'icon'        => 'bi bi-people',
                'order'       => 6,
                'is_active'   => true,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
        ];

        DB::table('services')->insert($services);
    }
}
