<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Users_Data extends Model
{
    use HasFactory;
    public $incrementing = true;
    protected $primaryKey = 'id';
    protected $fillable = ['username', 'fullname', 'email', 'telephone', 'address', 'password', 'role'];
    protected $table = 'users';

    public function balance()
    {
        return $this->hasOne(AccountBank::class, 'id');
    }
    public function child()
    {
        return $this->hasMany(Child::class);
    }



    // public function children() {
    //     return $this->hasMany(Child::class);
    // }

    // public function bankAccounts() {
    //     return $this->hasMany(AccountBank::class);
    // }

    // public function parentOf() {
    //     return $this->hasMany(Child::class, 'parent_id');
    // }

    // public function parent() {
    //     return $this->belongsTo(User::class, 'parent_id');
    // }
}
