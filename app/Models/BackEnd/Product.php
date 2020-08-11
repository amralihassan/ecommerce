<?php

namespace App\Models\BackEnd;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'en_product_name',
        'ar_product_name',
        'ar_description',
        'en_description',
        'country_id',
        'department_id',
        'category_id',
        'seller_id',
        'price',
        'discount_price',
        'item_condition',
        'note',
        'admin_id'
    ];
    public function admin()
    {
        return $this->belongsTo(App\Models\Admin::class);
    }
    public function category()
    {
        return $this->belongsTo('App\Models\BackEnd\Settings\Category','category_id');
    }
    public function department()
    {
        return $this->belongsTo('App\Models\BackEnd\Settings\Department','department_id');
    }
    public function seller()
    {
        return $this->belongsTo('App\Models\BackEnd\Seller','seller_id');
    }
    public function productSpecifications()
    {
        return $this->hasMany('App\Models\BackEnd\ProductSpecifications','product_id');
    }
    public function getItemConditionAttribute()
    {
        return $this->attributes['item_condition']  == 'new' ? trans('admin.new') : trans('admin.used');
    }

}
