<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_anyone_can_list_books(): void
    {
        Book::factory()->count(3)->create();

        $response = $this->getJson('/api/v1/books');

        $response->assertOk()
            ->assertJsonStructure(['data']);
    }

    public function test_anyone_can_view_a_book(): void
    {
        $book = Book::factory()->create();

        $response = $this->getJson("/api/v1/books/{$book->id}");

        $response->assertOk()
            ->assertJsonPath('data.id', $book->id);
    }

    public function test_guest_cannot_create_book(): void
    {
        $response = $this->postJson('/api/v1/books', [
            'title' => 'Test Book',
            'total_copies' => 1,
        ]);

        $response->assertUnauthorized();
    }

    public function test_authenticated_user_can_create_book(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user, 'sanctum')
            ->postJson('/api/v1/books', [
                'title' => 'كتاب تجريبي',
                'total_copies' => 2,
            ]);

        $response->assertCreated()
            ->assertJsonPath('data.title', 'كتاب تجريبي');
    }

    public function test_authenticated_user_can_delete_book(): void
    {
        $book = Book::factory()->create();
        $user = User::factory()->create();

        $this->actingAs($user, 'sanctum')
            ->deleteJson("/api/v1/books/{$book->id}")
            ->assertOk();
    }
}
