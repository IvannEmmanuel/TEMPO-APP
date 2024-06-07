<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistoryLog extends Model
{
    protected $table = 'DataHistory';

    protected $fillable = [
        'request_method', // HTTP request method (GET, POST, PUT, etc.)
        'response_status',// HTTP response status code
        'request_path', // HTTP request path
        'endpoint',       // Endpoint information
    ];
}
