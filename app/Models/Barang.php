<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';
    protected $primaryKey = 'idBrg';
    protected $fillable = [
        'idUser',
        'idKategori',
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

    public function kategori() {
        return $this->belongsTo(Kategori::class, 'idKategori', 'idKategori');
    }

    public function transaksiDetails() {
        return $this->hasMany(TransaksiDetail::class, 'idBrg', 'idBrg');
    }
}
