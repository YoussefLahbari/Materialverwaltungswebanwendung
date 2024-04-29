<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class materiel extends Model
{
    use HasFactory;
    protected $fillable = [
        "type",
        "marque",
        "model",
        "numero_serie",
        "numero_inventaire",
        "etat",
        "description",
        "site_id",
    ];
    public function repairs()
    {
        return $this->hasMany(Repair::class);
    }
    public function site()
    {
        return $this->belongsTo(Site::class);
    }
}

