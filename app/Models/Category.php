<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'shop_id'
    ];

    /**
     * Get the products for the category.
     */

    public function shop()
    {
        return $this->belongsTo(shop::class);
    }

}
