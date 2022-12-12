<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResetCodePassword extends Model
{
    use HasFactory;
    const UPDATED_AT = null;
    protected $table = 'ResetCodePassword';
    protected $fillable = [
        'email',
        'Token',
        'created_at',
    ];
}
