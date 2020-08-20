<?php

namespace App\Models\BackEnd\Settings;

use Illuminate\Database\Eloquent\Model;

class Specification extends Model
{
    protected $fillable = [
        'ar_specification_name',
        'en_specification_name',
        'sort',
        'admin_id'
    ];
    public function admin()
    {
        return $this->belongsTo(App\Models\Admin::class);
    }
    public function definitions()
    {
        return $this->hasMany('App\Models\BackEnd\Settings\Definition','specification_id');
    }
    public function productSpecifications()
    {
        return $this->hasMany('App\Models\BackEnd\ProductSpecifications','specification_id');
    }
    public function scopeSort($q)
    {
        return $q->orderBy('sort','asc');
    }
}
