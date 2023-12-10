<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    function register(RegisterRequest $request)
    {
        $validated = $request->validated();
        User::create($validated);
        return response()->success();
    }

    function auth(LoginRequest $request)
    {
        $validated = $request->validated();
        $user = User::whereName($validated['name'])->first();

        if ($user and Hash::check($validated['password'], $user->password)) {

            if (!$user->active)
                return response()->error(message: "Вы заблокированы", status: 401);

            $token = $user->createToken('token');
            return response()->success(['token' => $token->plainTextToken], "Авторизация успешна");
        }

        return response()->error(message: "Не верный логин или пароль", status: 422);
    }

    function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        
        return response()->success(message: "Вы вышли");
    }
}
