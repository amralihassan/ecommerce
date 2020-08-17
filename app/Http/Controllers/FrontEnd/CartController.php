<?php

namespace App\Http\Controllers\FrontEnd;
use App\Http\Controllers\Controller;
use App\Models\BackEnd\Cart;
use App\Models\BackEnd\Product;
use App\Models\BackEnd\Settings\Category;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
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

        return redirect()->route('cart.show');
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

    public function cartCheckout($amount)
    {
        $categories = Category::with('departments')->orderBy('sort','asc')->get();
        return view('layouts.frontEnd.pages.checkout',
        [
            'title'     =>trans('admin.buy'),
            'categories'=>$categories,
            'amount'    =>$amount,
            ]);
    }
    public function charge(Request $request)
    {
        $charge = Stripe::charges()->create([
            'currency'      => 'USD',
            'source'        => $request->stripeToken,
            'amount'        => $request->amount,
            'description'   => 'Test from online shop in laravel'
        ]);

        $chargeId = $charge['id'];

        if ($chargeId) { // accept payment
            // save orders
            auth()->user()->orders()->create([
                'cart' => serialize(session('cart'))
            ]);


            session()->forget('cart');
            toast(trans('admin.success_purchases'),'success');
            return redirect()->route('user.orders');
        }else{
            return back();
        }

    }

}
