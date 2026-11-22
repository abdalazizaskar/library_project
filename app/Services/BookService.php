<?php

namespace App\Services;

use App\Models\Book;
use Illuminate\Support\Str;

class BookService
{
    public function create(array $data): Book
    {
        $book = Book::create([
            'title' => $data['title'],
            'slug' => Str::slug($data['title']) . '-' . Str::random(4),
            'isbn' => $data['isbn'] ?? null,
            'description' => $data['description'] ?? null,
            'published_year' => $data['published_year'] ?? null,
            'total_copies' => $data['total_copies'],
        ]);

        if (! empty($data['categories'])) {
            $book->categories()->sync($data['categories']);
        }

        return $book->load('categories');
    }

    public function update(Book $book, array $data): Book
    {
        $book->update(collect($data)->except('categories')->all());

        if (array_key_exists('categories', $data)) {
            $book->categories()->sync($data['categories'] ?? []);
        }

        return $book->load('categories');
    }
}
