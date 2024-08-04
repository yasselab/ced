<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StructureRecherche extends Model
{
    use HasFactory;
    protected $table = 'structure_recherche';
    protected $fillable = [
        'nom_structure',
        'responsable',
        'type',
        'discipline',
        'description',
    ];
}
