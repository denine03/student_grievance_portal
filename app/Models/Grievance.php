<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grievance extends Model
{
    protected $fillable = [
    'student_id', 'category', 'assigned_to_id', 'is_emergency', 
    'subject', 'description', 'attachment_path', 'status'
    ];

    // A grievance belongs to a student
    public function student() {
        return $this->belongsTo(User::class, 'student_id');
    }

    // A grievance is assigned to a specific admin/faculty
    public function assignedTo() {
        return $this->belongsTo(User::class, 'assigned_to_id');
    }
}
