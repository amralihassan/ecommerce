<?php

namespace App\Http\Controllers\FrontEnd;
use App\Http\Controllers\Controller;
use App\Models\BackEnd\Offer;
use App\Models\BackEnd\Settings\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $offers = Offer::all();
        $categories = Category::with('departments')->orderBy('sort','asc')->get();
        return view('layouts.frontEnd.pages.dashboard',compact('offers','categories'));
    }
    public function product()
    {
        $categories = Category::with('departments')->orderBy('sort','asc')->get();
        return view('layouts.frontEnd.pages.product',compact('categories'));
    }
    public function allProducts()
    {
        $categories = Category::with('departments')->orderBy('sort','asc')->get();
        return view('layouts.frontEnd.pages.allProducts',compact('categories'));
    }
}
