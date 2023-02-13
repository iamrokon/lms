<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Invoice;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

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

    public function invoices(){
        return $this->hasMany(Invoice::class);
    }

    // public function attendances(){
    //     return $this->hasMany(Attendance::class);
    // }

    // public function notes(){
    //     return $this->hasMany(Note::class);
    // }

    // public function homeworks(){
    //     return $this->hasMany(Homework::class);
    // }

    public function is_present($curriculam_id) {
        return Attendance::where('user_id', $this->id)->where('curriculam_id', $curriculam_id)->exists();
    }
}
