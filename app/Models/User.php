<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'vallet_password',
        'reference_code',
        'membership_level_id',
        'parent_id',
        'credibility',
        'status',
        'funds',
        'user_type',
        'min_withdraw',
        'max_withdraw',
    ];

    public function isAdmin()
    {
        return $this->user_type == 1;
    }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];
    // Other model code...

    public function membershipLevel()
    {
        return $this->belongsTo(Membership::class, 'membership_level_id');
    }

    // If there's a parent-child relationship, define it as well
    public function parent()
    {
        return $this->belongsTo(User::class, 'parent_id');
    }

    // If funds and orders are already defined, ensure they're set up correctly
    public function funds()
    {
        return $this->hasMany(Funds::class);
    }

    public function orders()
    {
        return $this->hasMany(Orders::class);
    }

    public function children()
    {
        return $this->hasMany(User::class, 'parent_id');
    }

    // Define a recursive relationship to fetch all descendants
    public function descendants()
    {
        return $this->children()->with('descendants');
    }
}
