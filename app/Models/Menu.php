<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = ["title","slug","unit_price","TTC_price","image","category_id"];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    // public function facture(){
    //     return $this->belongsToMany(Facture::class);
    // }
}
