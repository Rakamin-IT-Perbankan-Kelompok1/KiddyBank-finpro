<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transaction'; // Gantilah 'nama_tabel_anda' dengan nama tabel di database Anda

    protected $fillable = [
        'id_transaction',
        'image',
        'recipient_name',
        'transaction_date',
        'account_number',
        'amount',
        'transaction_status',
    ];
}
