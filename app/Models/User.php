<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'type',
        'role_id',
        'document',
        'phone',
        'zip_code',
        'public_place',
        'number',
        'complement',
        'district',
        'city',
        'state',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function getTranslatedTypeAttribute(): string
    {
        switch ($this->type) {
            case 'admin':
                return 'Administrador da Plataforma';
            case 'partner':
                return 'Sócio';
            case 'collaborator':
                return 'Colaborador';
            case 'supplier':
                return 'Fornecedor';
            case 'client':
                return 'Cliente';
            default:
                return '';
        }
    }
}
