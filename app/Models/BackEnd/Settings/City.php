<?php

namespace App\Models\BackEnd\Settings;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = [
        'ar_city_name',
        'en_city_name',
        'country_id',
        'admin_id'
    ];
    public function admin()
    {
        return $this->belongsTo(App\Models\Admin::class);
    }
    public function country()
    {
        return $this->belongsTo(Country::class);

    }
}
