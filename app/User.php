<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Laravel\Passport\HasApiTokens;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'first_name',
        'last_name'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Universes owned by user
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function universes()
    {
        return $this->hasMany(Universe::class);
    }

    /**
     * Series owned by user
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function series()
    {
        return $this->hasMany(Series::class);
    }
}
