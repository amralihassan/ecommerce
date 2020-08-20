<?php

namespace App\Http\Controllers\FrontEnd;
use App\Http\Controllers\Controller;
use App\Models\BackEnd\Product;
use App\Models\BackEnd\Settings\Category;
use App\Models\FrontEnd\Order;
use Config;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        Config::set('auth.defaults.guard','web');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::with('departments')->orderBy('sort','asc')->get();
        $orders = auth()->user()->orders()->paginate(5);
        // dd($orders);
        $products = Product::all();
        $purchases = $orders->transform(function($cart,$key){
            return unserialize($cart->cart);
        });
        // dd($purchases);
        return view('layouts.frontEnd.orders.index',
        [
            'title'         => trans('admin.myPurchases'),
            'categories'    => $categories,
            'products'      => $products,
            'orders'        => $orders,
            'purchases'     => $purchases
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
