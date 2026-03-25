<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index(Request $request)
    {
        $users = User::query()
            ->when($request->id, function ($query, $id) {
                $query->where('id', $id);
            })
            ->when($request->name, function ($query, $name) {
                $query->where('name', 'like', "%{$name}%");
            })
            ->when($request->email, function ($query, $email) {
                $query->where('email', 'like', "%{$email}%");
            })
            ->when($request->date, function ($query, $date) {
                $query->whereDate('created_at', $date);
            })
            ->paginate(10);

        return UserResource::collection($users->appends($request->all()));
    }

    public function show($id)
    {
        return new UserResource(
            User::findOrFail($id)
        );
    }
}
