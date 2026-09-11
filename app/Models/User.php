<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

// 📍 ហៅមុខងារ Avatar និង សិទ្ធិចូល Panel របស់ Filament មកប្រើ
use Filament\Models\Contracts\HasAvatar; 
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;

// 📍 ថែម "FilamentUser" នៅក្បែរ HasAvatar
class User extends Authenticatable implements HasAvatar, FilamentUser
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

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

    // 📍 មុខងារទាញរូប logo.png មកបង្ហាញនៅជ្រុងខាងស្តាំ
    public function getFilamentAvatarUrl(): ?string
    {
        return asset('images/logo.png');
    }

    // 📍 មុខងារដោះស្រាយ Error 403 (អនុញ្ញាតឱ្យចូលផ្ទាំង Admin)
    public function canAccessPanel(Panel $panel): bool
    {
        return true; 
    }
}