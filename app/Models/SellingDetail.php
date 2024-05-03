<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellingDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'selling_id',
        'product_id',
        'qty',
        'price',
        'subtotal'
    ];

    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id');
    }

    public function selling()
    {
        return $this->belongsTo(Selling::class, 'selling_id');
    }
}
