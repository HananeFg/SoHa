<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Details extends Model
{
    use HasFactory;

    protected $fillable = [
        "facture_id",
        "produit_id",
        "quantity",
        "unit_price",
        "montant"
    ];

    public function factures(){
        return $this->belongsTo(Factures::class);
    }
}
