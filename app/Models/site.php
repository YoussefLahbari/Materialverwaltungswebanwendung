<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class site extends Model
{
    protected $fillable = [
        'type_poste',
        'nom_bureau',
        'num_bureau',
        'telephone',
        'fax',
        'wilaya',
        'prefecture',
    ] ;
    use HasFactory;
}
