<?php

namespace App\Models;

use App\Enums\RoleEnum;
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
        'name',
        'email',
        'password',
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
    ];

    public function hasCreatedTickets()
    {
        return $this->hasMany(Ticket::class, 'creator_id');
    }

    public function hasResolvedPosts()
    {
        return $this->hasMany(Ticket::class, 'resolver_id');
    }

    public function isQA()
    {
        return $this->role_id == RoleEnum::QA;
    }

    public function isPM()
    {
        return $this->role_id == RoleEnum::PM;
    }

    public function isRD()
    {
        return $this->role_id == RoleEnum::RD;
    }
}
