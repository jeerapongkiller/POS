<?php

namespace App;

use App\Model\Outlet;
use App\Model\UserOutlet;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function userOutlet()
    {
        return $this->hasMany(Outlet::class,'owner_id');
    }

    public function sellsManOutlet()
    {
        return $this->hasOne(UserOutlet::class);
    }
}
