<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disbursement extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'id',
        'bank_code',
        'account_number',
        'amount',
        'remark',
        'status',
        'timestamp',
        'beneficiary_name',
        'receipt',
        'time_served',
        'fee'
    ];
}
