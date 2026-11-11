<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Review;
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
        'name',
        'email',
        'password',
        'phone',
        'role',
        'address',
        'profile_image',
        'banner',
        'industry_license',
        'about',
        'status',
        'province',
        'country',
        'country_code',
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
        'password' => 'hashed',
    ];

    public function business()
{
    return $this->hasOne(Company::class);
}

public function portfolios()
{
    return $this->hasMany(Portfolio::class);
}
public function company()
{
    return $this->hasOne(Company::class);
}

public function sentMessages()
{
    return $this->hasMany(Chat::class, 'sender_id');
}

public function receivedMessages()
{
    return $this->hasMany(Chat::class, 'receiver_id');
}

    public function reviews()
    {
        return $this->hasMany(Review::class, 'user_id');
    }

    public function writtenReviews()
    {
        return $this->hasMany(Review::class, 'reviewer_id');
    }

    public function savedProfiles()
    {
        return $this->hasMany(SavedProfile::class, 'user_id');
    }

    public function savedByProfiles()
    {
        return $this->hasMany(SavedProfile::class, 'manufacturer_id');
    }

public function sentNotifications()
{
    return $this->hasMany(Notification::class, 'from_user_id');
}

public function unreadNotifications()
{
    return $this->hasMany(Notification::class)->where('is_read', false);
}
}
