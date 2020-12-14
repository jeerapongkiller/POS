<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Sell extends Model
{
    public function products()
    {
        return $this->hasMany(SellProduct::class)->with('product');
    }

    public function sellValue()
    {
        return $this->hasMany(SellProduct::class)->sum('price');
    }

    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function outlet()
    {
        return $this->belongsTo(Outlet::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function payment()
    {
        return $this->hasOne(SellPayment::class);
    }
}
