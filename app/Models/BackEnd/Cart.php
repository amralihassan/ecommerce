<?php

namespace App\Models\BackEnd;

class Cart
{
    public $items = [];

    public $totalQty; // Total shopping cart

    public $totalPrice;

    public $created_at;

    public function __construct($cart = null)
    {
        if ($cart) {
            $this->items        = $cart->items;
            $this->totalQty     = $cart->totalQty;
            $this->totalPrice   = $cart->totalPrice;
            $this->created_at   = $cart->created_at;
        }else{
            // set cart
            $this->items        = [];
            $this->totalQty     = 0;
            $this->totalPrice   = 0;
            $this->created_at   = null;
        }
    }

    public function add($product)
    {
        $item = [
            'id'                => $product->id,
            'item'              => session('lang') == 'ar' ? $product->ar_product_name :$product->en_product_name,
            'brand'             => $product->brand,
            'note'              => $product->note,
            'discount_price'    => $product->discount_price,
            'item_condition'    => $product->item_condition,
            'price'             => $product->price,
            'qty'               => 0,  //The quantity purchased
            'image'             => $product->product_image,
        ];

        if (!array_key_exists($product->id,$this->items)) {
            $this->items[$product->id] = $item;
            $this->totalQty +=1;
            $this->totalPrice +=$product->price;
        }else{
            $this->totalQty +=1;
            $this->totalPrice +=$product->price;
        }

        $this->items[$product->id]['qty'] +=1;

        $this->created_at =\Carbon\Carbon::now();
    }

    public function remove($product_id)
    {
        if (array_key_exists($product_id,$this->items)) {
            $this->totalQty -=$this->items[$product_id]['qty'];
            $this->totalPrice -=$this->items[$product_id]['qty'] * $this->items[$product_id]['price'];
            unset($this->items[$product_id]);
        }
    }

    public function updateQuantity($product_id,$qty)
    {
        $this->totalQty -=$this->items[$product_id]['qty'];
        $this->totalPrice -=$this->items[$product_id]['qty'] * $this->items[$product_id]['price'];

        $this->items[$product_id]['qty'] = $qty;

        $this->totalQty +=$qty;
        $this->totalPrice +=$qty* $this->items[$product_id]['price'];
    }
}
