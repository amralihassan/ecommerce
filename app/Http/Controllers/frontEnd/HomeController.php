<?php

namespace App\Http\Controllers\frontEnd;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('layouts.frontEnd.pages.dashboard');
    }
    public function product()
    {
        return view('layouts.frontEnd.pages.product');
    }
    public function allProducts()
    {
        return view('layouts.frontEnd.pages.allProducts');
    }
}
