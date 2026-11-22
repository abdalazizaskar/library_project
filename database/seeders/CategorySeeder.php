<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'روايات',
                'slug' => 'novels',
                'description' => 'روايات عربية وعالمية في القصة الطويلة.',
            ],
            [
                'name' => 'تاريخ',
                'slug' => 'history',
                'description' => 'كتب التاريخ والحضارات والسير.',
            ],
            [
                'name' => 'علوم',
                'slug' => 'science',
                'description' => 'العلوم الطبيعية والتطبيقية والمبسطة.',
            ],
            [
                'name' => 'فلسفة',
                'slug' => 'philosophy',
                'description' => 'الفكر الفلسفي والأسئلة الكبرى.',
            ],
            [
                'name' => 'شعر',
                'slug' => 'poetry',
                'description' => 'الدواوين والشعر العربي.',
            ],
            [
                'name' => 'أطفال',
                'slug' => 'children',
                'description' => 'قصص وكتب مناسبة للأطفال.',
            ],
            [
                'name' => 'دين',
                'slug' => 'religion',
                'description' => 'الكتب الدينية والفكر الإسلامي.',
            ],
            [
                'name' => 'تنمية ذاتية',
                'slug' => 'self-development',
                'description' => 'تطوير الذات والمهارات والعادات.',
            ],
        ];

        foreach ($categories as $category) {
            Category::query()->updateOrCreate(
                ['slug' => $category['slug']],
                $category,
            );
        }
    }
}
