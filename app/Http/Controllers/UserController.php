<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        return view('users.index', [
            'title' => 'User Accounts',
            'users' => User::query()->orderBy('id')->get(),
        ]);
    }
}
