<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class OutletPayment extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function outlet()
    {
        return $this->belongsTo(Outlet::class);
    }
}
