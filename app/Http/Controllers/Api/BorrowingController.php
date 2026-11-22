<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Borrowing;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class BorrowingController extends Controller
{
    public function index(Request $request)
    {
        $borrowings = Borrowing::with(['user', 'book'])
            ->where('user_id', $request->user()->id)
            ->latest()
            ->paginate(15);

        return response()->json($borrowings);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'book_id' => 'required|exists:books,id',
            'days' => 'nullable|integer|min:1|max:60',
        ]);

        $user = $request->user();
        $book = Book::findOrFail($data['book_id']);

        if ($book->availableCopiesCount() <= 0) {
            return response()->json(['message' => 'لا توجد نسخ متاحة'], 409);
        }

        $already = Borrowing::where('user_id', $user->id)
            ->where('book_id', $book->id)
            ->whereIn('status', ['borrowed', 'overdue'])
            ->exists();

        if ($already) {
            return response()->json(['message' => 'لديك استعارة نشطة لهذا الكتاب'], 409);
        }

        $days = $data['days'] ?? 14;
        $borrowedAt = Carbon::today();

        $borrowing = Borrowing::create([
            'user_id' => $user->id,
            'book_id' => $book->id,
            'borrowed_at' => $borrowedAt,
            'due_date' => $borrowedAt->copy()->addDays($days),
            'status' => 'borrowed',
        ]);

        $borrowing->load(['user', 'book']);

        return response()->json($borrowing, 201);
    }

    public function show(Request $request, Borrowing $borrowing)
    {
        if ((int) $request->user()->id !== (int) $borrowing->user_id) {
            return response()->json(['message' => 'غير مسموح'], 403);
        }

        $borrowing->load(['user', 'book']);

        return response()->json($borrowing);
    }

    public function returnBook(Request $request, Borrowing $borrowing)
    {
        if ((int) $request->user()->id !== (int) $borrowing->user_id) {
            return response()->json(['message' => 'غير مسموح'], 403);
        }

        if ($borrowing->status === 'returned') {
            return response()->json(['message' => 'تم الإرجاع مسبقاً'], 409);
        }

        $borrowing->update([
            'returned_at' => Carbon::today(),
            'status' => 'returned',
        ]);

        $borrowing->load(['user', 'book']);

        return response()->json($borrowing);
    }
}
