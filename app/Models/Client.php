<?php

namespace App\Models;
use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Client extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $with = ['projects'];

    public function TodoList(): HasMany
    {
        return $this->hasMany(TodoList::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_clients');
    }

    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class);
    }
}
