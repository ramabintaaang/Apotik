<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Obat extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'kode',
        'dosis',
        'indikasi',
        'kategori',
        'satuan',
    ];

    public static function join()
    {
        $data = DB::select('SELECT a.*,b.kategori,c.satuan FROM obats a JOIN kategoris b ON a.kategori =
                b.id JOIN satuans c ON a.satuan = c.id');

        return $data;
    }
}
