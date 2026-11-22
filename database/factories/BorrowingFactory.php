<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Borrowing>
 */
class BorrowingFactory extends Factory
{
    public function definition(): array
    {
        $borrowedAt = fake()->dateTimeBetween('-60 days', 'now');

        return [
            'user_id' => User::factory(),
            'book_id' => Book::factory(),
            'borrowed_at' => $borrowedAt,
            'due_date' => date('Y-m-d', strtotime('+14 days', $borrowedAt->getTimestamp())),
            'returned_at' => null,
            'status' => 'borrowed',
        ];
    }

    public function returned(): static
    {
        return $this->state(fn (array $attrs) => [
            'returned_at' => date('Y-m-d', strtotime('+10 days', strtotime($attrs['borrowed_at']))),
            'status' => 'returned',
        ]);
    }

    public function overdue(): static
    {
        return $this->state(fn (array $attrs) => [
            'due_date' => date('Y-m-d', strtotime('-5 days')),
            'status' => 'overdue',
        ]);
    }
}
