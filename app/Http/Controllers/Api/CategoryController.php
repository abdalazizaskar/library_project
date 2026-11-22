<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    // GET /api/v1/categories
    public function index()
    {
        $categories = Category::withCount('books')->orderBy('name')->get();

        return response()->json($categories);
    }

    // POST /api/v1/categories
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $category = Category::create([
            'name' => $data['name'],
            'slug' => Str::slug($data['name']) . '-' . Str::random(4),
            'description' => $data['description'] ?? null,
        ]);

        return response()->json($category, 201);
    }

    // GET /api/v1/categories/{category}
    public function show(Category $category)
    {
        $category->load('books');

        return response()->json($category);
    }

    // PUT/PATCH /api/v1/categories/{category}
    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $category->update($data);

        return response()->json($category);
    }

    // DELETE /api/v1/categories/{category}
    public function destroy(Category $category)
    {
        if ($category->books()->exists()) {
            return response()->json(['message' => 'لا يمكن حذف تصنيف مرتبط بكتب'], 409);
        }

        $category->delete();

        return response()->json(['message' => 'تم حذف التصنيف']);
    }
}
