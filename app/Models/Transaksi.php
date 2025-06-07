<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';
    protected $fillable = [
        'idUser',
        'totalHrgJual',
        'totalHrgModal',
        'uangDibayar',
        'uangKembalian',
        'laba',
        'tanggalTransaksi',
    ];

    public function details(){
        return $this->hasMany(TransaksiDetail::class, 'idTransaksi', 'idTransaksi');
    }

    public function user(){
        return $this->belongsTo(User::class, 'idUser', 'idUser');
    }
}
