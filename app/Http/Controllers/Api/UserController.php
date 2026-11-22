<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(Request $request, User $user)
    {
        if ((int) $request->user()->id !== (int) $user->id) {
            return response()->json(['message' => 'غير مسموح'], 403);
        }

        return response()->json($user);
    }

    public function update(Request $request, User $user)
    {
        if ((int) $request->user()->id !== (int) $user->id) {
            return response()->json(['message' => 'غير مسموح'], 403);
        }

        $data = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'phone' => 'nullable|string|max:30',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        if (empty($data['password'])) {
            unset($data['password']);
        }

        $user->update($data);

        return response()->json($user);
    }
}
