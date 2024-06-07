<?php

 namespace App\Models;

 use Illuminate\Database\Eloquent\Model;

 class SignUp extends Model{

    protected $table = 'DataSignUp';

    // column sa table

    protected $fillable = [
        'username', 'password', 'gender', 'birthday', 'age', 'address',
    ];

    protected $primaryKey = 'uid';

    public $timestamps = false;

 }