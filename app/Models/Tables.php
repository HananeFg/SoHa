<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tables extends Model
{
    use HasFactory;

    protected $table = 'tables';


    protected $fillable = [
        "name",
        "slug",
        "status"
    ];

    public function factures()
    {
        return $this->hasMany(Factures::class);
    }

}
