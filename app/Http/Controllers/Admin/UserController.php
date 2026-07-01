<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        $users = User::query()
            ->when(auth()->id(), fn ($query) => $query->where('id', '!=', auth()->id()))
            ->orderByDesc('id')
            ->paginate(10);

        return view('screens.admin.users.index', compact('users'));
    }
}
