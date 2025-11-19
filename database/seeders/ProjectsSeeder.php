<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectsSeeder extends Seeder
{
    public function run()
    {
        // Get service IDs
        $signboardService = DB::table('services')->where('name', 'Signboard')->first();
        $brandingService  = DB::table('services')->where('name', 'Branding & Digital Printing')->first();
        $furnitureService = DB::table('services')->where('name', 'Furniture & Interior Design')->first();

        $projects = [
            [
                'name'           => 'Commercial Signboard Project',
                'description'    => 'Professional signboard installation for commercial business in Erbil city center',
                'main_image'     => 'projects/1.jpg',
                'gallery_images' => json_encode([
                    'projects/1.jpg',
                    'projects/2.jpg',
                    'projects/3.jpg',
                ]),
                'service_id'     => $signboardService->id,
                'order'          => 1,
                'is_active'      => true,
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'name'           => 'Corporate Branding Project',
                'description'    => 'Complete corporate branding solution including digital printing for major company',
                'main_image'     => 'projects/4.jpg',
                'gallery_images' => json_encode([
                    'projects/4.jpg',
                    'projects/5.jpg',
                    'projects/6.jpg',
                ]),
                'service_id'     => $brandingService->id,
                'order'          => 2,
                'is_active'      => true,
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'name'           => 'Office Furniture Installation',
                'description'    => 'Custom office furniture design and installation for modern workspace',
                'main_image'     => 'projects/7.jpg',
                'gallery_images' => json_encode([
                    'projects/7.jpg',
                    'projects/8.jpg',
                    'projects/9.jpg',
                ]),
                'service_id'     => $furnitureService->id,
                'order'          => 3,
                'is_active'      => true,
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
        ];

        DB::table('projects')->insert($projects);
    }
}
