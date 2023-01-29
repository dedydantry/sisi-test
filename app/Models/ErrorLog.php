<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ErrorLog extends Model
{
    use HasFactory;

    protected $table = 'error_log';

    protected $fillable = [
        'user_id',
        'modules',
        'controller',
        'function',
        'error_line',
        'error_message',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
}
