<?php

namespace App\Models\BackEnd;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $fillable = [
        'image_offer_name',
        'title',
        'start_offer',
        'link',
        'status_display',
        'start_display',
        'end_display',
        'admin_id'
    ];
    public function admin()
    {
        return $this->belongsTo('App\Models\Admin','admin_id');
    }
}
