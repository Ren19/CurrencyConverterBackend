<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Webhook extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'target_url', 
        'target_currency', 
        'threshold', 
        'created_by'
    ];
}
