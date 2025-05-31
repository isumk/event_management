<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'assigned_to',
        'description',
        'status',
        'start_date',
        'due_date',
    ];
    protected $casts = [
    'start_date' => 'date',
    'due_date' => 'date',
];


    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}
