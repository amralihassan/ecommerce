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
    public function divisions()
    {
        return $this->hasMany('App\Models\Student\Division','admin_id');
    }
    public function grades()
    {
        return $this->hasMany('App\Models\Student\Grade','admin_id');
    }
    public function years()
    {
        return $this->hasMany('App\Models\Student\Year','admin_id');
    }
    public function guardians()
    {
        return $this->hasMany('App\Models\Student\Guardian','admin_id');
    }
    public function students()
    {
        return $this->hasMany('App\Models\Student\Student','admin_id');
    }
    public function fees()
    {
        return $this->hasMany('App\Models\Fees\Feesment','admin_id');
    }
    public function invoices()
    {
        return $this->hasMany('App\Models\Fees\Invoice','admin_id');
    }
    public function payments()
    {
        return $this->hasMany('App\Models\Fees\Payment','admin_id');
    }
    public function grade_fees()
    {
        return $this->hasMany('App\Models\Fees\GradeFees','admin_id');
    }
}
