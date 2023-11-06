<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    protected $table = 'transfer'; // Sesuaikan dengan nama tabel di database

    protected $fillable = [
        'sender_account',
        'recipient_account',
        'amount',
    ];

    // Tambahkan hubungan atau metode lain jika diperlukan
}

