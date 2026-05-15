<?php

use App\Models\Grievance;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('student.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('grievance.{grievance}', function ($user, Grievance $grievance) {
    if ($user->role !== 'student') {
        return true;
    }

    return (int) $user->id === (int) $grievance->student_id;
});