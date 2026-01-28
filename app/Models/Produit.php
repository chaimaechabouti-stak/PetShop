<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use CloudinaryLabs\CloudinaryLaravel\MediaAlly;

class Produit extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'description',
        'prix',
        'categorie',
        'image',
        'en_stock',
        'quantite',
        'en_solde',
        'prix_solde',
        'pourcentage_reduction'
    ];

    protected $casts = [
        'prix' => 'decimal:2',
        'prix_solde' => 'decimal:2',
        'en_stock' => 'boolean',
        'en_solde' => 'boolean',
        'quantite' => 'integer',
        'pourcentage_reduction' => 'integer'
    ];
}