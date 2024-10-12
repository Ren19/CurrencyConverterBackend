<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversion extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'source_currency', 
        'target_currency', 
        'original_amount', 
        'converted_amount', 
        'is_active', 
        'created_by'
    ];
}
