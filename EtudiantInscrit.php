<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EtudiantInscrit extends Model
{
    use HasFactory;

    // Spécifiez le nom de la table si elle ne suit pas la convention
    protected $table = 'etudiants_inscrits';

    // Indiquez les champs qui peuvent être assignés en masse
    protected $fillable = [
        'num_ins_condida',
        'nom_fr',
        'nom_ar',
        'prenom_fr',
        'prenom_ar',
        'date_nai',
        'email',
        'cin',
        'appogee',
        'sexe',
        'lieu_nai_fr',
        'lieu_nai_ar',
        'tele_1',
        'tele_2',
        'address_fr',
        'address_ar',
        'image',
        'handicape',
        'profession',
        'password',
        'num_dossier'
    ];
    public function getAuthPassword()
    {
        return $this->password;
    }

    // Optionnel : Listez les attributs à masquer lors de la conversion en tableau ou JSON
    protected $hidden = [
        'password', // Pour éviter de montrer les mots de passe en clair
    ];

    // Optionnel : Spécifiez les champs de type date
    protected $dates = [
        'date_nai',
    ];

    // Optionnel : Si vous souhaitez utiliser les timestamps
    public $timestamps = true;
}

