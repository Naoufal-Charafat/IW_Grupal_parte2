<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Traits\HasMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles, HasMedia, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'telefono',
        'line_1',
        'line_2',
        'postal_code',
        'esta_activo',
        'tipo',
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
            'esta_activo' => 'boolean',
        ];
    }

    /**
     * Get the professional profile associated with this user.
     */
    public function profesional()
    {
        return $this->hasOne(Profesional::class);
    }

    /**
     * Get the hotel profile associated with this user.
     */
    public function hotel()
    {
        return $this->hasOne(Hotel::class);
    }

    /**
     * Get the reservations made by this user (as client).
     */
    public function reservas()
    {
        return $this->hasMany(Reserva::class);
    }

    /**
     * Get the reservations created by this user (as staff/admin).
     */
    public function reservasCreadas()
    {
        return $this->hasMany(Reserva::class, 'creado_por');
    }

    /**
     * Get the reviews written by this user.
     */
    public function resenas()
    {
        return $this->hasMany(Resena::class, 'cliente_id');
    }
}
