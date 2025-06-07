<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';
    protected $fillable = [
        'idUser',
        'fotoBrg',
        'namaBrg',
        'kodeBrg',
        'stokBrg',
        'hrgModal',
        'hrgJual',
    ];

    public function user() {
        return $this->belongsTo(User::class, 'idUser', 'idUser');
    }

    public function transaksiDetails() {
        return $this->hasMany(TransaksiDetail::class, 'idBrg', 'idBrg');
    }
}
