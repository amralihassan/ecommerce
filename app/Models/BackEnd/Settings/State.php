<?php

namespace App\Models\BackEnd\Settings;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $fillable = [
        'ar_state_name',
        'en_state_name',
        'country_id',
        'city_id',
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
    public function city()
    {
        return $this->belongsTo(City::class);

    }
}
