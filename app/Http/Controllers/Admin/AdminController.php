<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('pages.admin.index', [
            'title' => 'Car Rental',
            'active' => 'dashboard'
        ]);
    }
}
