<?php
namespace App\Models\BackEnd\Settings;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'ar_category_name',
        'en_category_name',
        'icon',
        'sort',
        'description',
        'keywords',
        'admin_id'
    ];
    public function admin()
    {
        return $this->belongsTo(App\Models\Admin::class);
    }
    public function departments()
    {
        return $this->hasMany(Department::class,'category_id');
    }
}
