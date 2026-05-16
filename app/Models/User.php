<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'student_id',
        'school',
        'department'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function isStudent() {
        return $this->role === 'student';
    }

    public function isAdmin() {
        return in_array($this->role, ['admin', 'registrar', 'vice_chancellor']);
    }

    public function isFaculty() {
        return in_array($this->role, ['hod', 'dean', 'dsw_head']);
    }
}