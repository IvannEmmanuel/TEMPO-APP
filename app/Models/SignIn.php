<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SignIn extends Model
{
    // Specify the table name
    protected $table = 'DataSignIn';

    // Define the fillable attributes
    protected $fillable = [
        'username', 'password', 'gender',
    ];

    // Define the primary key
    protected $primaryKey = 'uid';

    // Disable timestamps
    public $timestamps = false;
}