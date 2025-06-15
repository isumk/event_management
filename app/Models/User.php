<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Role;
use App\Models\Task;
// Ensure you have the Role model imported

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected $casts = [
      'email_verified_at' => 'datetime',
      'password' => 'hashed',
    ];

    public function role()
    {
    return $this->belongsTo(Role::class);
    }
    public function assignedTasks()
    {
        return $this->hasMany(Task::class, 'assigned_to');
    }
    public function eventsCollaborating()
    {
     return $this->belongsToMany(Event::class, 'event_user');
    }



}
