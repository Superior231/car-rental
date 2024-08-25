<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Car;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $banners = Banner::orderBy('updated_at', 'desc')->get();
        $cars = Car::orderBy('created_at', 'desc')->get();

        return view('pages.index', [
            'title' => 'Car Rental',
            'active' => 'dashboard',
            'banners' => $banners,
            'cars' => $cars
        ]);
    }
}
