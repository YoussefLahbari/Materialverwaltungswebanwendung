<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class requete extends Model
{
    use HasFactory;
    protected $fillable = [
        'request_type', 
        'quantity',
        'site_id',
    ];
}
