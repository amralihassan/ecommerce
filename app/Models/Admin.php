<?php

namespace App\Models;
use App\Models\Students\Division;
use App\Models\Students\Grade;
use App\Models\Students\Student;
use App\Models\Students\Guardian;
use App\Models\Students\Year;
use App\Models\Fees\Feesment;
use App\Models\Fees\GradeFees;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Admin extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','username', 'email', 'password','image','lang','status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function username()
    {
        return 'username';
    }
    public function settings()
    {
        $this->hasOne(App\Models\Setting::class);
    }
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
    public function getStatusAttribute()
    {
        return $this->attributes['status'] == 'enable' ? trans('admin.active') : trans('admin.inactive');
    }
    public function getLangAttribute()
    {
        return $this->attributes['lang'] == 'en' ? trans('admin.en') : trans('admin.ar');
    }
    public function getUsernameAttribute($value)
    {
        return $this->attributes['username'] = $value;
    }
    public function countries()
    {
        return $this->hasMany('App\Models\BackEnd\Settings\Country','admin_id');
    }
    public function cities()
    {
        return $this->hasMany('App\Models\BackEnd\Settings\City','admin_id');
    }
    public function states()
    {
        return $this->hasMany('App\Models\BackEnd\Settings\State','admin_id');
    }
    public function categories()
    {
        return $this->hasMany('App\Models\BackEnd\Settings\Category','admin_id');
    }
    public function departments()
    {
        return $this->hasMany('App\Models\BackEnd\Settings\Department','admin_id');
    }
    public function specifications()
    {
        return $this->hasMany('App\Models\BackEnd\Settings\Specification','admin_id');
    }
    public function offers()
    {
        return $this->hasMany('App\Models\BackEnd\Offer','admin_id');
    }
    public function sellers()
    {
        return $this->hasMany('App\Models\BackEnd\Seller','admin_id');
    }
    public function definitions()
    {
        return $this->hasMany('App\Models\BackEnd\Settings\Definition','admin_id');
    }
    public function products()
    {
        return $this->hasMany('App\Models\BackEnd\Product','admin_id');
    }
    public function productSpecifications()
    {
        return $this->hasMany('App\Models\BackEnd\ProductSpecifications','admin_id');
    }

}
