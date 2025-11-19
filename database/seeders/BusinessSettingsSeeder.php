<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BusinessSettingsSeeder extends Seeder
{
    public function run()
    {
        $settings = [
            [
                'type'       => 'company_name',
                'value'      => 'AlRaad',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type'       => 'identity_name',
                'value'      => 'AlRaad - Thunder',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type'       => 'tagline',
                'value'      => 'For contracting & Advertising',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type'       => 'heroBtnText',
                'value'      => 'Book Appointment',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type'       => 'about_title',
                'value'      => 'Who are we',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type'       => 'about_content',
                'value'      => 'AlRaad stands out as your premier partner for full-spectrum advertising and production services. Our expertise extends far beyond event execution and direct marketing—we deliver innovative, all-in-one solutions paired with creative consultancy to transform your ideas into reality.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type'       => 'mission_title',
                'value'      => 'Our Mission',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type'       => 'mission_content',
                'value'      => 'We are dedicated to making a significant impact on our customers, vendors, and employees through our professional skills. With extensive experience in branding, events, launches, signage, printing, and interior design, AlRaad is equipped to handle all your advertising needs. Our deep expertise is evident in every project we complete.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type'       => 'coverage_title',
                'value'      => 'Where do we serve?',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type'       => 'coverage_content',
                'value'      => 'From city limits to limitless skies, AlRaad\'s teams cover every corner of Iraq!',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type'       => 'phone',
                'value'      => '+964 772 223 4030',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type'       => 'contact_phone',
                'value'      => 'https://wa.me/9647722234030',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type'       => 'contact_email',
                'value'      => 'swatalraadoffice@gmail.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('business_settings')->insert($settings);
    }
}
