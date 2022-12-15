<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FicheVT extends Model
{
    use HasFactory;
    protected $fillable = ['npa', 'date_construction', 'nbre_panneaux', 'puissance', 'marque', 'type_onduleur',
     'batteries', 'commentaire', 'rdv_vt', 'rdv_rbe', 'client_id'];

    public function project(): BelongsToMany
    {
        return $this->belongsTo(Project::class);
    }
}
