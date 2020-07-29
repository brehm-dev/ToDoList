<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @method static find($id)
 * @method static create(array $array)
 * @property integer id
 */
class User extends Authenticatable
{
    use Notifiable;

    const ROLE_ADMIN    = 'ROLE_ADMIN';
    const ROLE_USER     = 'ROLE_USER';

    const TABLE_NAME = 'users';
    const TABLE_USERNAME = 'username';
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
        'username', 'email', 'password', 'role'
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
    public function isRoleAdmin()
    {
        if ($this->getAttribute('role') === self::ROLE_ADMIN) return true;
        return false;
    }

    /**
     * @return bool
     */
    public function isRoleUser() {
        if ($this->getAttribute('role') === self::ROLE_USER) return true;
        return false;
    }

    /**
     * @return string|bool
     */
    public function getRole()
    {
        return $this->getAttribute('role');
    }

}
