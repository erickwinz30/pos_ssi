<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Selling extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'pos_session_id',
        'code',
        'total',
        'payment',
        'changes',
        'status',
        'payment_method',
    ];

    public function cashier()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function cashierSession()
    {
        return $this->belongsTo(PosSession::class, 'pos_session_id');
    }

    public function sellingDetails()
    {
        return $this->hasMany(SellingDetail::class);
    }
}
