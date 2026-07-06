<?php

namespace App\Http\Controllers;

use App\Models\Tip;
use Illuminate\View\View;

class TipController extends Controller
{
    public function show(Tip $tip): View
    {
        abort_unless($tip->status, 404);

        $tip->load('tipsCategory');

        return view('pages.tips.show', compact('tip'));
    }
}
