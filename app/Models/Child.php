<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Child extends Model
{
    use HasFactory;
    public $incrementing = true;
    protected $primaryKey = 'id';
    protected $fillable = ['id_user','username', 'fullname', 'email', 'telephone', 'address', 'password', 'otp', 'expired_otp'];
    protected $table = 'child';
    public $timestamps = false;
}
