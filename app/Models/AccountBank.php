<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountBank extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = ['balance', 'account_number'];
    protected $table = 'bankaccount';

    public function user()
    {
        return $this->belongsTo(Users_Data::class, 'id');
    }
}
