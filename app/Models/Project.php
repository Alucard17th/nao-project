<?php

namespace App\Models;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Project extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;

    public function clients(): BelongsToMany
    {
        return $this->belongsToMany(Client::class);
    }

    public function fiche_vtc()
    {
        return $this->hasOne(FicheVT::class);
    }
}
