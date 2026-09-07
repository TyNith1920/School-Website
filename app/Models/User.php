<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

// 📍 ១. ថែមបន្ទាត់នេះ ដើម្បីហៅមុខងារ Avatar របស់ Filament មកប្រើ
use Filament\Models\Contracts\HasAvatar; 

// 📍 ២. ថែម "implements HasAvatar" នៅទីនេះ
class User extends Authenticatable implements HasAvatar
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

    // 📍 ៣. ថែម Function នេះនៅខាងក្រោមគេ ដើម្បីទាញរូប logo.png មកបង្ហាញនៅជ្រុងខាងស្តាំ
    public function getFilamentAvatarUrl(): ?string
    {
        return asset('images/logo.png');
    }
}