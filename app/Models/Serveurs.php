<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Serveurs extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "email",
        "tel",
        "address"
    ];

    public function factures()
    {
        return $this->hasMany(Factures::class);
    }
}
