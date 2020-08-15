<?php

namespace App\Http\Controllers\FrontEnd;
use App\Http\Controllers\Controller;
use App\Models\BackEnd\Cart;
use App\Models\BackEnd\Product;
use App\Models\BackEnd\Settings\Category;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart($product_id)
    {
        $product = Product::findOrFail($product_id);

        if (session()->has('cart')) {
            $cart = new Cart(session('cart'));
        }else{
            $cart = new Cart;
        }

        $cart->add($product);

        session()->put('cart',$cart); // add $cart to session

        return redirect()->route('all.products',$product->department_id);
    }

    public function showCart()
    {
        if (session()->has('cart')) {
            $cart = new Cart(session('cart'));
        }else{
            $cart = new Cart;
        }
        $categories = Category::with('departments')->orderBy('sort','asc')->get();
        return view('layouts.frontEnd.pages.cart',
        [
            'title'         =>trans('admin.cart'),
            'cart'          =>$cart,
            'categories'    =>$categories
        ]);
    }

}
