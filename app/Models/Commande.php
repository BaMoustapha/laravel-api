<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;

    protected $fillable = [
        'statut',
        'produits',
        'total',
        'prenom',
        'email',
        'telephone',
        'ville',
        'adresse',
    ]
    ;

    protected $casts = [
        'produits' => 'json', // Conversion de la colonne 'produits' en JSON
    ];
}
