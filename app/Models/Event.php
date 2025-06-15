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
    public function progress()
    {
      $totalTasks = $this->tasks()->count();
      if ($totalTasks === 0) return 0;
      $completedTasks = $this->tasks()->where('status', 'completed')->count();
      return round(($completedTasks / $totalTasks) * 100);
   }
   public function collaborators()
   {
     return $this->belongsToMany(User::class, 'event_user');
   }

   public function progressForCollaborator($userId)
   {
       $totalTasks = $this->tasks()->where('assigned_to', $userId)->count();
         if ($totalTasks === 0) {
          return 0;
       }
       $completedTasks = $this->tasks()->where('assigned_to', $userId)->where('status', 'completed')->count();

      return round(($completedTasks / $totalTasks) * 100);
    }



}
