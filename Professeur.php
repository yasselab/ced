<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Professeur extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom_complet',
        'grade',
        'formation_doctorale',
        'nombre_theses',
        'encadrements',
    ];

}
