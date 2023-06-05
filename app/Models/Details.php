<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
        return $this->belongsTo(Factures::class, 'facture_id');
    }

    public function menus(){
        return $this->belongsTo(Menu::class, 'produit_id');
    }
}
