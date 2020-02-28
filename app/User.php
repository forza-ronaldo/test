<?php

namespace App;

use App\Notifications\sendVerify;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'id_number', 'user_name', 'phone', 'city', 'gender', 'group_id', 'bank_id','token','token_reset_password'
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
    public function Questions()
    {
        return $this->hasMany(question::class);
    }
    public  function  verified()
    {
        return $this->token===null;
    }
    public  function  sendVerificationEmail()
    {
        $this->notify(new sendVerify($this));

    }
}
