<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiDetail extends Model
{
    use HasFactory;
    protected $table = 'transaksi_detail';
    protected $primaryKey = 'idDetail';

    protected $fillable = [
        'idTransaksi',
        'idBrg',
        'jumlah',
        'hrgJualSatuan',
        'hrgModalSatuan',
    ];

    public function barang(){
        return $this->belongsTo(Barang::class, 'idBrg', 'idBrg');
    }

    public function transaksi(){
        return $this->belongsTo(Transaksi::class, 'idTransaksi', 'idTransaksi');
    }
}
