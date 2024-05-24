<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'shop_id'
    ];

    /**
     * Get the products for the category.
     */
  // Relation belongsTo dans Category : Une catégorie appartient à une seule boutique.
    public function shop()
    {
        return $this->belongsTo(shop::class);
    }

}
