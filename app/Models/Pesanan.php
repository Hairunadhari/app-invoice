<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;
    protected $guarded = [''];

    public function keranjang()
    {
        return $this->belongsTo(Keranjang::class);
    }
   

    
}
