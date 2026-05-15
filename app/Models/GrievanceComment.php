<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GrievanceComment extends Model
{
    protected $guarded = [];

    public function user() {
        return $this->belongsTo(User::class);
    }
    
    public function grievance() {
        return $this->belongsTo(Grievance::class);
    }
}