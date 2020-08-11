<?php

namespace App\Models\BackEnd;

use Illuminate\Database\Eloquent\Model;

class ProductSpecifications extends Model
{
    protected $table = 'product_specifications';

    protected $fillable = [
        'product_id',
        'specification_id',
        'definition_id',
        'admin_id'
    ];
    public function admin()
    {
        return $this->belongsTo(App\Models\Admin::class);
    }
    public function product()
    {
        return $this->belongsTo('App\Models\BackEnd\Product','product_id');
    }
    public function definition()
    {
        return $this->belongsTo('App\Models\BackEnd\Settings\Definition','definition_id');
    }
    public function specification()
    {
        return $this->belongsTo('App\Models\BackEnd\Settings\Specification','specification_id');
    }
}
