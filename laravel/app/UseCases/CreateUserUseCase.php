<?php

namespace App\UseCases;

use App\DTO\UserDTO;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateUserUseCase {

    public function execute(UserDTO $dto) {
        return User::create([
            'name' => $dto->name,
            'email' => $dto->email,
            'password' => Hash::make($dto->password)
        ]);
    }
}