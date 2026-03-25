<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Resources\UserResource;

class UserController extends Controller {

    public function index() {
        return UserResource::collection(
            User::paginate(10)
        );
    }

    public function show($id) {
        return new UserResource(
            User::findOrFail($id)
        );
    }
}