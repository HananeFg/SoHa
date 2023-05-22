<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factures extends Model
{
    use HasFactory;

    protected $fillable = [
        "serveur_id",
        "client_id",
        "table_id",
        "total_price",
        "total_recieved",
        "change",
        "payment_type",
        "payment_status",
        "datetime_facture"
    ];


    public function details()
    {
        return $this->belongsToMany(Details::class);
    }

    public function serveur()
    {
        return $this->belongsTo(Serveurs::class, 'serveur_id');
    }
    
    public function table()
    {
        return $this->belongsTo(Tables::class, 'table_id');
    }
    

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
