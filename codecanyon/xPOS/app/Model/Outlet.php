<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Outlet extends Model
{

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function owner()
    {
        return $this->belongsTo(User::class,'owner_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function outletTax()
    {
        return $this->hasOne(OutletTax::class);
    }

    public function outletCharges()
    {
        return $this->hasMany(OutletCharge::class);
    }

    public function outletPayment()
    {
        return $this->hasMany(OutletPayment::class);
    }

    public function sells()
    {
        return $this->hasMany(Sell::class);
    }

    public function sellCharge()
    {
        return $this->hasMany(SellCharge::class);
    }
}
