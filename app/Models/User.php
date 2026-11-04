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
        'agency_id',
        'is_owner',
    ];

    public function agency()
    {
        return $this->belongsTo(Agency::class);
    }

    /**
     * Check if the user is the primary Agency Owner.
     */
    public function isAgencyOwner(): bool
    {
        if ($this->is_owner) {
            return true;
        }

        // Fallback: the earliest user created for the agency is the owner
        if ($this->agency_id) {
            $firstUserId = static::where('agency_id', $this->agency_id)->orderBy('id', 'asc')->value('id');
            return $firstUserId && (int) $this->id === (int) $firstUserId;
        }

        return false;
    }

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
            'is_owner' => 'boolean',
        ];
    }
}
