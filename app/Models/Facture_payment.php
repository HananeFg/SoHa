<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facture_payment extends Model
{
    use HasFactory;
    protected $table = 'facture_payment';

    protected $fillable = [
        "facture_id",
        "payment_id",
        "payment_type",
        "payment_status",
        "montant"   
    ];

}
