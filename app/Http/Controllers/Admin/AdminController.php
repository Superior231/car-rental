<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        $customerCount = User::all()->count();
        $carCount = Car::all()->count();

        return view('pages.admin.index', [
            'title' => 'Dashboard',
            'active' => 'dashboard',
            'customerCount' => $customerCount,
            'carCount' => $carCount
        ]);
    }
}
