<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Carbon;

/**
 * @method static find($id)
 */
class User extends Authenticatable
{
    use Notifiable;

    const ROLE_ADMIN    = 'ADMIN';
    const ROLE_MASTER   = 'MASTER';
    const ROLE_USER     = 'USER';

    const TABLE_NAME = 'users';
    const TABLE_FIRST_NAME = 'first_name';
    const TABLE_LAST_NAME = 'last_name';
    const TABLE_EMAIL = 'email';
    const TABLE_EMAIL_VERIFIED_AT = 'email_verified_at';
    const TABLE_PASSWORD = 'password';
    const TABLE_ROLE = 'role';
    const TABLE_REMEMBER_TOKEN = 'remember_token';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'role'
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




    /**
     * @return bool
     */
    public function roleIsAdmin() {
        if ($this->attributes['role'] === self::ROLE_ADMIN) return true;
        return false;
    }

    /**
     * @return bool
     */
    public function roleIsMaster()
    {
        if ($this->attributes['role'] === self::ROLE_MASTER) return true;
        return false;
    }

    /**
     * @return bool
     */
    public function roleIsUser() {
        if ($this->attributes['role'] === self::ROLE_USER) return true;
        return false;
    }
}
