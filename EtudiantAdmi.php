<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EtudiantAdmi extends Model
{
    use HasFactory;
    protected $table = 'etudiants_admis';
    protected $fillable = [
        'nom_complet', 'cin', 'cne', 'encadrant', 'co_encadrant', 'sujet',
    ];
}
