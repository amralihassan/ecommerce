<?php
namespace App\Models\BackEnd;

use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    protected $fillable = [
        'seller_name',
        'mobile',
        'email',
        'activition',
        'address',
        'admin_id'
    ];
    public function admin()
    {
        return $this->belongsTo(App\Models\Admin::class);
    }
}
