<?php

namespace Database\Seeders;
use App\Models\Tool;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ToolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $tools = [
            [
                'category_id' => Category::where('name', 'Elektronik')->firstOrFail()->id,
                'code' => 'ALT001',
                'name' => 'Laptop',
                'description' => 'Laptop untuk kebutuhan praktik',
                'stock' => 10,
                'condition' => 'good',
                'is_active' => true,
            ],
            [
                'category_id' => Category::where('name', 'Multimedia')->firstOrFail()->id,
                'code' => 'ALT002',
                'name' => 'Kamera DSLR',
                'description' => 'Kamera untuk dokumentasi',
                'stock' => 5,
                'condition' => 'good',
                'is_active' => true,
            ],
            [
                'category_id' => Category::where('name', 'Perkakas')->firstOrFail()->id,
                'code' => 'ALT003',
                'name' => 'Bor Listrik',
                'description' => 'Bor untuk praktik pertukangan',
                'stock' => 7,
                'condition' => 'good',
                'is_active' => true,
            ],
        ];

        foreach ($tools as $tool) {
            Tool::updateOrCreate(
                ['code' => $tool['code']],
                $tool
            );
        }
    }
}
