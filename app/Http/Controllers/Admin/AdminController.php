<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $customerCount = User::all()->count();

        return view('pages.admin.index', [
            'title' => 'Dashboard',
            'active' => 'dashboard',
            'customerCount' => $customerCount
        ]);
    }
}
