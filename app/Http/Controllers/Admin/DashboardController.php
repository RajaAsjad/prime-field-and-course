<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();

        $stats = [
            'totalUsers' => User::query()
                ->when($user?->id, fn ($query) => $query->where('id', '!=', $user->id))
                ->count(),
        ];

        return view('screens.admin.dashboard.index', compact('user', 'stats'));
    }
}
