<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    public function definition(): array
    {
        $title = fake()->sentence(4);

        return [
            'title' => $title,
            'slug' => Str::slug($title) . '-' . Str::random(6),
            'isbn' => fake()->optional()->isbn13(),
            'description' => fake()->optional()->paragraph(),
            'cover_path' => null,
            'published_year' => fake()->numberBetween(1800, (int) date('Y')),
            'total_copies' => fake()->numberBetween(1, 10),
        ];
    }

    public function withCategories(int $count = 2): static
    {
        return $this->afterCreating(function ($book) use ($count) {
            $ids = Category::factory()->count($count)->create()->pluck('id');
            $book->categories()->sync($ids);
        });
    }
}
