<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'avatar',
        'name',
        'surname',
        'contacts',
        'birthday',
        'auth_address',

        'phone',
        'country',
        'country_code',
        'city',
        'city_code',
        'verified_at',
        'password',

        'contributed',
        'contributed_usd',
        'invested',
        'invested_usd',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'contacts' => 'json',
        'birthday' => 'date'
    ];

    public function roles(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Role::class,'role_user');
    }

    public function pools(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Pool::class,'owner_id');
    }

    public function contributions(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Transaction::class,'contributor_id');
    }

    public function company(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Company::class,'owner_id');
    }

    public function wallets(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Wallet::class);
    }

    public function getAddressMaskedAttribute() {

        return implode('...',[substr($this->auth_address,0,5),substr($this->auth_address,-4)]);
    }
}
