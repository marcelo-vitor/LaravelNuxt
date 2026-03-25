<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\DTO\UserDTO;
use App\UseCases\CreateUserUseCase;
use App\Http\Resources\UserResource;

class AuthController extends Controller {

    public function register(Request $request, CreateUserUseCase $useCase) {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:6'
        ]);

        $dto = new UserDTO($data['name'], $data['email'], $data['password']);
        $user = $useCase->execute($dto);

        return new UserResource($user);
    }

    public function login(Request $request) {
        $data = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (!Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
            return response()->json(['message' => 'Credenciais inválidas'], 401);
        }

        return new UserResource(Auth::user());
    }

    public function logout(Request $request) {
        Auth::guard('web')->logout();

        if ($request->hasSession()) {
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }

        return response()->json(['message' => 'Logout realizado']);
    }

    public function user(Request $request) {
        return new UserResource($request->user());
    }
}
