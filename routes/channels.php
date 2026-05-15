<?php

use App\Models\Grievance;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('grievance.{id}', function ($user, $id) {
    $grievance = Grievance::find($id);
    return $user->role !== 'student' || (int) $user->id === (int) $grievance->student_id;
});