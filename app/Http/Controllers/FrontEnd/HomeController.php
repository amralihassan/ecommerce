<?php

namespace App\Http\Controllers\FrontEnd;
use App\Http\Controllers\Controller;
use App\Models\BackEnd\Offer;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $offers = Offer::all();
        return view('layouts.frontEnd.pages.dashboard',compact('offers'));
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
