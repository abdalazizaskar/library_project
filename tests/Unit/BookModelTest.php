<?php

namespace Tests\Unit;

use App\Models\Book;
use App\Models\Borrowing;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookModelTest extends TestCase
{
    use RefreshDatabase;

    public function test_available_copies_count_is_correct(): void
    {
        $book = Book::factory()->create(['total_copies' => 3]);
        $user = User::factory()->create();

        Borrowing::factory()->create([
            'book_id' => $book->id,
            'user_id' => $user->id,
            'status' => 'borrowed',
        ]);

        $this->assertSame(2, $book->availableCopiesCount());
        $this->assertSame(1, $book->borrowedCopiesCount());
    }

    public function test_borrowing_is_overdue_when_past_due_and_not_returned(): void
    {
        $borrowing = Borrowing::factory()->overdue()->create();

        $this->assertTrue($borrowing->isOverdue());
    }
}
