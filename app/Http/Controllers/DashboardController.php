<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;

class DashboardController extends Controller
{
    public function index()
    {
        $data = Peminjaman::latest()->get();

        return view('page.dashboard.index', compact('data'));
    }
}
