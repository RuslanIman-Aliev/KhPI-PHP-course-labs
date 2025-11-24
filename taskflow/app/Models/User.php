<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $fillable = ['name','email','password'];

    protected $hidden = ['password','remember_token'];

    // User owns many projects (as owner)
    public function ownedProjects()
    {
        return $this->hasMany(Project::class, 'owner_id');
    }

    // User belongs to many projects (member)
    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_user')->withPivot('role')->withTimestamps();
    }

    public function tasksAuthored()
    {
        return $this->hasMany(Task::class, 'author_id');
    }

    public function tasksAssigned()
    {
        return $this->hasMany(Task::class, 'assignee_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'author_id');
    }
}
