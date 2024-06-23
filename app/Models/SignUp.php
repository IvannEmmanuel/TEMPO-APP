<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SignUp extends Model
{
    // Specify the table name
    protected $table = 'DataSignUp';

    // Define the fillable attributes
    protected $fillable = [
        'username', 'password', 'gender', 'birthday', 'age', 'address',
    ];

    // Define the primary key
    protected $primaryKey = 'uid';

    // Disable timestamps
    public $timestamps = false;
}