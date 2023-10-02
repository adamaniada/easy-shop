<?php
// app/Models/Cart.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Import the SoftDeletes trait

class Cart extends Model
{
    use SoftDeletes; // Use the SoftDeletes trait

    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
    ];

    protected $dates = ['deleted_at']; // Specify the 'deleted_at' column as a date field

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relation avec le modèle "Product" pour lier un panier à un produit
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
