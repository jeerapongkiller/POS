<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class OutletCharge extends Model
{
    public function outletCharge()
    {
        return $this->belongsTo(Charge::class,'charge_id')->withTrashed();
    }
}
