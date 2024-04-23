<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'user_id',
        'logo',
        'banniere',
        'telephone',
        'email',
        'addresse',
        'a_propos'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
