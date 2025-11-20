<?php
namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        $brands = [
            ['name' => 'AlFakher', 'logo' => 'alfakher.png', 'link' => null, 'order' => 1],
            ['name' => 'Infinix', 'logo' => 'infinix.png', 'link' => null, 'order' => 2],
            ['name' => 'OPPO', 'logo' => 'oppo.png', 'link' => null, 'order' => 3],
            ['name' => 'Realme', 'logo' => 'realme.png', 'link' => null, 'order' => 4],
            ['name' => 'Cihan', 'logo' => 'cihan.png', 'link' => null, 'order' => 5],
            ['name' => 'Ford', 'logo' => 'ford.png', 'link' => null, 'order' => 6],
            ['name' => 'IDB', 'logo' => 'idb.png', 'link' => null, 'order' => 7],
            ['name' => 'NBI', 'logo' => 'nbi.png', 'link' => null, 'order' => 8],
            ['name' => 'Rotana', 'logo' => 'rotana.png', 'link' => null, 'order' => 9],
        ];

        foreach ($brands as $brand) {
            Brand::create([
                'name' => $brand['name'],
                'logo' => $brand['logo'],
                'link' => $brand['link'],
            ]);
        }
    }
}
