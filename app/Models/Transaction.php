<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    // Gantilah 'nama_tabel_anda' dengan nama tabel di database Anda
    public $incrementing = true;
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'id_bankaccount',
        'acountNumber',
        'amount',
        'recipientAccount',
        'senderName',
        'recepientName',
        'senderType',
        'transaction_status',
        'created_at',
    ];
    protected $table = 'transactions';

    public function transfer()
    {
        return $this->belongsTo(AccountBank::class, 'account_number', 'acountNumber');
    }
    // public function transaction()
    // {
    //     return $this->hasMany(Child::class);
    // }
}
