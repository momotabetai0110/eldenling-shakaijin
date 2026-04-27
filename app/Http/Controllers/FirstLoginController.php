<?php

namespace App\Http\Controllers;

use App\Services\FirstLoginService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FirstLoginController extends Controller
{
    public function login(Request $request, FirstLoginService $firstLoginService): JsonResponse
    {
        $validated = $request->validate([
            'user_name' => ['required', 'string', 'max:255'],
        ]);

        $userUuid = $firstLoginService->createUser($validated['user_name']);

        return response()->json([
            'user_uuid' => $userUuid,
        ]);
    }
}
