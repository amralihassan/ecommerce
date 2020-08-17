<?php

namespace App\Models\FrontEnd;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['cart','user_id'];

    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }
}
