<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function index(Book $book)
    {
        $ratings = $book->ratings()->with('user')->latest()->get();

        return response()->json([
            'average' => round($ratings->avg('rating') ?? 0, 2),
            'ratings' => $ratings,
        ]);
    }

    public function store(Request $request, Book $book)
    {
        $data = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string|max:1000',
        ]);

        $exists = Rating::where('user_id', $request->user()->id)
            ->where('book_id', $book->id)
            ->exists();

        if ($exists) {
            return response()->json(['message' => 'قمت بتقييم هذا الكتاب مسبقاً'], 409);
        }

        $rating = Rating::create([
            'user_id' => $request->user()->id,
            'book_id' => $book->id,
            'rating' => $data['rating'],
            'review' => $data['review'] ?? null,
        ]);

        $rating->load('user');

        return response()->json($rating, 201);
    }

    public function update(Request $request, Rating $rating)
    {
        if ((int) $request->user()->id !== (int) $rating->user_id) {
            return response()->json(['message' => 'غير مسموح'], 403);
        }

        $data = $request->validate([
            'rating' => 'sometimes|required|integer|min:1|max:5',
            'review' => 'nullable|string|max:1000',
        ]);

        $rating->update($data);

        return response()->json($rating);
    }

    public function destroy(Request $request, Rating $rating)
    {
        if ((int) $request->user()->id !== (int) $rating->user_id) {
            return response()->json(['message' => 'غير مسموح'], 403);
        }

        $rating->delete();

        return response()->json(['message' => 'تم حذف التقييم']);
    }
}
