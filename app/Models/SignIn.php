<?php

 namespace App\Models;

 use Illuminate\Database\Eloquent\Model;

 class SignIn extends Model{

    protected $table = 'DataSignIn';

    // column sa table

    protected $fillable = [
        'username', 'password', 'gender',
    ];

    protected $primaryKey = 'uid';

    public $timestamps = false;

 }