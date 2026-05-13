<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grievance extends Model
{
    protected $fillable = [
    'student_id', 'category', 'assigned_to_id', 'is_emergency', 
    'subject', 'description', 'attachment_path', 'status',
    ];

    public function student() {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function assignedTo() {
        return $this->belongsTo(User::class, 'assigned_to_id');
    }
}
