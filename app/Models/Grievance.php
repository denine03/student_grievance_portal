<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Grievance extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function student() {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function assignedTo() {
        return $this->belongsTo(User::class, 'assigned_to_id');
    }

    public function comments() {
        return $this->hasMany(GrievanceComment::class)->latest();
    }
}