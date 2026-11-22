<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $books = [
            [
                'title' => 'موسم الهجرة إلى الشمال',
                'slug' => 'season-of-migration-to-the-north',
                'isbn' => '978-977-090-001-1',
                'description' => 'رواية الطيب صالح عن الغربة والهوية بين السودان وإنجلترا.',
                'published_year' => 1966,
                'total_copies' => 5,
                'categories' => ['novels'],
            ],
            [
                'title' => 'أولاد حارتنا',
                'slug' => 'children-of-the-alley',
                'isbn' => '978-977-090-002-8',
                'description' => 'رواية نجيب محفوظ التي تعيد قراءة تاريخ الحارة بوصف رمزي.',
                'published_year' => 1959,
                'total_copies' => 4,
                'categories' => ['novels'],
            ],
            [
                'title' => 'ثلاثية غرناطة',
                'slug' => 'granada-trilogy',
                'isbn' => '978-977-090-003-5',
                'description' => 'رواية رضوى عاشور عن سقوط غرناطة ومصير أهلها.',
                'published_year' => 1994,
                'total_copies' => 3,
                'categories' => ['novels', 'history'],
            ],
            [
                'title' => 'رجال في الشمس',
                'slug' => 'men-in-the-sun',
                'isbn' => '978-977-090-004-2',
                'description' => 'رواية غسان كنفاني عن ثلاثة فلسطينيين يبحثون عن عمل في الكويت.',
                'published_year' => 1963,
                'total_copies' => 6,
                'categories' => ['novels'],
            ],
            [
                'title' => 'الأيام',
                'slug' => 'al-ayyam',
                'isbn' => '978-977-090-005-9',
                'description' => 'سيرة طه حسين الذاتية عن نشأته وفقدان البصر وطلب العلم.',
                'published_year' => 1929,
                'total_copies' => 4,
                'categories' => ['novels', 'history'],
            ],
            [
                'title' => 'مقدمة ابن خلدون',
                'slug' => 'muqaddimah',
                'isbn' => '978-977-090-006-6',
                'description' => 'مقدمة ابن خلدون في العمران والتاريخ وطبائع الدول.',
                'published_year' => 1377,
                'total_copies' => 3,
                'categories' => ['history', 'philosophy'],
            ],
            [
                'title' => 'عبقرية عمر',
                'slug' => 'abqariyat-omar',
                'isbn' => '978-977-090-007-3',
                'description' => 'كتاب عباس محمود العقاد عن شخصية عمر بن الخطاب.',
                'published_year' => 1942,
                'total_copies' => 5,
                'categories' => ['history', 'religion'],
            ],
            [
                'title' => 'الحيوان',
                'slug' => 'al-hayawan',
                'isbn' => '978-977-090-008-0',
                'description' => 'موسوعة الجاحظ في طبائع الحيوان وما يحيط بها من أخبار.',
                'published_year' => 850,
                'total_copies' => 2,
                'categories' => ['science'],
            ],
            [
                'title' => 'ديوان المتنبي',
                'slug' => 'diwan-al-mutanabbi',
                'isbn' => '978-977-090-009-7',
                'description' => 'ديوان أبي الطيب المتنبي، من أشهر دواوين الشعر العربي.',
                'published_year' => 965,
                'total_copies' => 7,
                'categories' => ['poetry'],
            ],
            [
                'title' => 'الشوقيات',
                'slug' => 'al-shawqiyat',
                'isbn' => '978-977-090-010-3',
                'description' => 'ديوان أحمد شوقي في المدح والرثاء والوصف والمسرح الشعري.',
                'published_year' => 1898,
                'total_copies' => 3,
                'categories' => ['poetry'],
            ],
            [
                'title' => 'كليلة ودمنة',
                'slug' => 'kalila-wa-dimna',
                'isbn' => '978-977-090-011-0',
                'description' => 'حكايات على لسان الحيوان نقلها ابن المقفع، تصلح للقراءة مع الأطفال.',
                'published_year' => 750,
                'total_copies' => 8,
                'categories' => ['children', 'philosophy'],
            ],
            [
                'title' => 'إحياء علوم الدين',
                'slug' => 'ihya-ulum-al-din',
                'isbn' => '978-977-090-012-7',
                'description' => 'كتاب الإمام الغزالي في الفقه الباطن وآداب العبادة.',
                'published_year' => 1106,
                'total_copies' => 2,
                'categories' => ['religion', 'philosophy'],
            ],
            [
                'title' => 'العادات الذرية',
                'slug' => 'atomic-habits',
                'isbn' => '978-977-090-013-4',
                'description' => 'ترجمة عربية لكتاب جيمس كلير عن بناء العادات الصغيرة.',
                'published_year' => 2018,
                'total_copies' => 6,
                'categories' => ['self-development'],
            ],
            [
                'title' => 'موجز تاريخ الزمن',
                'slug' => 'a-brief-history-of-time',
                'isbn' => '978-977-090-014-1',
                'description' => 'ترجمة عربية لكتاب ستيفن هوكينغ عن نشأة الكون والثقوب السوداء.',
                'published_year' => 1988,
                'total_copies' => 4,
                'categories' => ['science', 'philosophy'],
            ],
        ];

        foreach ($books as $data) {
            $categorySlugs = $data['categories'];
            unset($data['categories']);

            $book = Book::query()->updateOrCreate(
                ['slug' => $data['slug']],
                $data,
            );

            $categoryIds = Category::query()
                ->whereIn('slug', $categorySlugs)
                ->pluck('id');

            $book->categories()->sync($categoryIds);
        }
    }
}
