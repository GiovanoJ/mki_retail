<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    public function run(): void
    {
        $legacy = [
            'wall_panel' => 'Wall Panel',
            'decking'    => 'Decking',
            'facade'     => 'Facade',
            'ceiling'    => 'Ceiling',
            'flooring'   => 'Flooring',
            'door'       => 'Door',
            'rotan'      => 'Rotan',
            'kabel'      => 'Kabel',
        ];

        $order = 0;
        foreach ($legacy as $slug => $label) {
            ProductCategory::firstOrCreate(
                ['slug' => $slug],
                [
                    'label'       => $label,
                    'show_in_tab' => true,
                    'order'       => $order++,
                ]
            );
        }
    }
}
