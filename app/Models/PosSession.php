<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PosSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'initial_cash',
        'cash_in',
        'changes',
        'ending_cash',
        'ending_cash_actual',
        'transaction_count',
        'start_at',
        'end_at',
    ];
}
