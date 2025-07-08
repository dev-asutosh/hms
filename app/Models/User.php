<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

// 👇 ADD THESE TWO LINES
use Spatie\Permission\Traits\HasRoles;
use Filament\Panel;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles; // 👈 Add HasRoles here

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // 👇 ADD THIS METHOD AT THE END OF THE CLASS
    public function canAccessPanel(Panel $panel): bool
    {
        return $this->hasRole('admin');
    }

    public function doctor()
    {
        return $this->hasOne(Doctor::class);
    }
   
}
