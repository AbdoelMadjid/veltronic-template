<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Check if user has master or admin role.
     */
    public function isMasterOrAdmin(): bool
    {
        try {
            return $this->hasAnyRole(['master', 'admin']);
        } catch (\Throwable $e) {
            return in_array($this->role ?? '', ['master', 'admin']);
        }
    }

    /**
     * Check if user has master role.
     */
    public function isMaster(): bool
    {
        try {
            return $this->hasRole('master');
        } catch (\Throwable $e) {
            return ($this->role ?? '') === 'master';
        }
    }
}
