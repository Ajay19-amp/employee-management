<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;


class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'phone', 'address'
    ];

    // Automatically hash password before saving
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value); // ✅ Now it works!
    }
}
