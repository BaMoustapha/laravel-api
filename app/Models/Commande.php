<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'prenom',
        'name',
        'telephone',
        'adresse',
        'ville',
        'quantite',
         'image',
        'statut',
        'prixProduit',
        'prixTotal',
        'product_id',
        'prixLivraison',
         'produits',
    ]
    ;

    protected $casts = [
        'produits' => 'array', // Cast le champ en array
    ];

    
        public function product()
    {
        return $this->belongsTo(Product::class);
    }
    // protected $casts = [
    //     'produits' => 'json', // Conversion de la colonne 'produits' en JSON
    // ];
}
