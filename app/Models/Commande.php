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
        //'image',
        'statut',
        'prixProduit',
        'prixTotal',
        'product_id',
        'prixLivraison',
        'produits',
    ]
    ;

    protected $casts = [
        // 'product_id' => 'array',
        'produits' => 'array', 
    ];

    
        public function product()
    {
        return $this->belongsTo(Product::class);
    }

}
