<?php

namespace App\Models\BackEnd\Settings;

use Illuminate\Database\Eloquent\Model;

class Definition extends Model
{
    protected $fillable = [
        'ar_value',
        'en_value',
        'specification_id',
        'department_id',
        'sort',
        'admin_id'
    ];
    public function admin()
    {
        return $this->belongsTo(App\Models\Admin::class);
    }
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    public function specification()
    {
        return $this->belongsTo(Specification::class);
    }
    public function productSpecifications()
    {
        return $this->hasMany('App\Models\BackEnd\ProductSpecifications','definition_id');
    }

}
