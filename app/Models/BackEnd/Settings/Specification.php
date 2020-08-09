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
}
