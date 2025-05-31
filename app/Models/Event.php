<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'start_date', 'end_date', 'status', 'created_by',
    ];
    protected $casts = [
    'start_date' => 'date',
    'end_date' => 'date',
];
    /**
     * Get the user that created the event.
     */

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function tasks()
    {
         return $this->hasMany(Task::class);
    }

}
