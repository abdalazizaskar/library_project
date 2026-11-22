<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(Book $book)
    {
        $comments = $book->comments()->with('user')->latest()->paginate(20);

        return response()->json($comments);
    }

    public function store(Request $request, Book $book)
    {
        $data = $request->validate([
            'body' => 'required|string|max:2000',
        ]);

        $comment = Comment::create([
            'user_id' => $request->user()->id,
            'book_id' => $book->id,
            'body' => $data['body'],
        ]);

        $comment->load('user');

        return response()->json($comment, 201);
    }

    public function update(Request $request, Comment $comment)
    {
        if ((int) $request->user()->id !== (int) $comment->user_id) {
            return response()->json(['message' => 'غير مسموح'], 403);
        }

        $data = $request->validate([
            'body' => 'required|string|max:2000',
        ]);

        $comment->update($data);

        return response()->json($comment);
    }

    public function destroy(Request $request, Comment $comment)
    {
        if ((int) $request->user()->id !== (int) $comment->user_id) {
            return response()->json(['message' => 'غير مسموح'], 403);
        }

        $comment->delete();

        return response()->json(['message' => 'تم حذف التعليق']);
    }
}
