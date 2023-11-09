<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Child extends Model
{
    use HasFactory;
    public $incrementing = true;
    protected $primaryKey = 'id';
    protected $fillable = ['id_user','child_username', 'child_fullname', 'email', 'telephone', 'address', 'password', 'otp', 'expired_otp'];
    protected $table = 'child';
    public $timestamps = false;

    public function users_data()
    {
        return $this->belongsTo(Users_Data::class, 'id_user', 'id');
    }
}
