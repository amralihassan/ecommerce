<?php

namespace App\Http\Controllers\FrontEnd;
use App\Http\Controllers\Controller;
use App\Models\BackEnd\Cart;
use App\Models\BackEnd\Product;
use App\Models\BackEnd\Settings\Category;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Config;
use Illuminate\Http\Request;


class CartController extends Controller
{
    public function __construct()
    {
        Config::set('auth.defaults.guard','web');
    }
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
        $products = Product::all();
        return view('layouts.frontEnd.pages.cart',
        [
            'title'         =>trans('admin.cart'),
            'cart'          =>$cart,
            'categories'    =>$categories,
            'products'      =>$products
        ]);
    }

    public function cartCheckout($amount)
    {
        $categories = Category::with('departments')->orderBy('sort','asc')->get();
        $products = Product::all();
        return view('layouts.frontEnd.pages.checkout',
        [
            'title'         =>trans('admin.buy'),
            'categories'    =>$categories,
            'products'      =>$products,
            'amount'        =>$amount,
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
            // // save orders
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

    public function remove($product_id)
    {
        $cart = new Cart(session('cart'));
        $cart->remove($product_id);

        if ($cart->totalQty <= 0) {
            session()->forget('cart');
        }else{
            session()->put('cart',$cart); // add $cart to session
        }

        toast(trans('admin.item_removed'),'success');

        return redirect()->route('cart.show');
    }

    public function updateQuantity($product_id)
    {
        request()->validate([
            'qty' => 'required|numeric|min:1'
        ],[
            'qty.required'  => trans('admin.qty_required'),
            'qty.numeric'   => trans('admin.qty_numeric'),
            'qty.min'       => trans('admin.qty_min'),
        ]);
        $cart = new Cart(session('cart'));
        $cart->updateQuantity($product_id,request('qty'));
        session()->put('cart',$cart);
        return redirect()->route('cart.show');
    }

}
