<?php

namespace App\Models\BackEnd\Settings;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = [
        'ar_department_name',
        'en_department_name',
        'category_id',
        'description',
        'keywords',
        'show',
        'sort',
        'department_image',
        'admin_id'
    ];
    public function admin()
    {
        return $this->belongsTo(App\Models\Admin::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function products()
    {
        return $this->hasMany('App\Models\BackEnd\Product','department_id');
    }
    public function getShowAttribute()
    {
        return $this->attributes['show'] == 'yes' ? trans('admin.yes') : trans('admin.no');
    }
    public function scopeShow($query)
    {
        return $query->where('show','yes');
    }
}
