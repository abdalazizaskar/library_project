<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Http\Resources\BookResource;
use App\Models\Book;
use App\Services\BookService;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::with('categories');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('isbn', 'like', "%{$search}%");
            });
        }

        $books = $query->latest()->paginate(15);

        return BookResource::collection($books);
    }

    public function store(StoreBookRequest $request, BookService $service)
    {
        $book = $service->create($request->validated());

        return (new BookResource($book))->response()->setStatusCode(201);
    }

    public function show(Book $book)
    {
        $book->load(['categories', 'ratings.user', 'comments.user']);

        return new BookResource($book);
    }

    public function update(UpdateBookRequest $request, Book $book, BookService $service)
    {
        $book = $service->update($book, $request->validated());

        return new BookResource($book);
    }

    public function destroy(Book $book)
    {
        if ($book->borrowings()->whereIn('status', ['borrowed', 'overdue'])->exists()) {
            return response()->json(['message' => 'لا يمكن حذف كتاب عليه استعارات نشطة'], 409);
        }

        $book->delete();

        return response()->json(['message' => 'تم حذف الكتاب']);
    }
}
