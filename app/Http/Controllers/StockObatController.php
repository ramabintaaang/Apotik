<?php

namespace App\Http\Controllers;

use App\Models\StockObat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;


class StockObatController extends Controller
{
    public function index(Request $request)
    {
        $data = DB::select('select id,nama,stok,harga_beli,harga_jual from stocks');
        if ($request->ajax()) {
            return Datatables::of($data)
                // ->addIndexColumn()
                ->addColumn('aksi', function ($data) {
                    $button = '<div class="btn-group">
                        <button type="button" class="btn btn-primary edit" id="' . $data->id . '" >
                            <i class="fas fa-pen-alt"></i>
                        </button>
                        <button type="button" class="btn btn-danger hapus" id="' . $data->id . '" >
                            <i class="fas fa-trash"></i>
                        </button>
                        </div>';
                    // $button = '<button class="btn btn-primary edit" id="' . $data->id . '" name="edit">Edit</button>';
                    // $button .= '<button class="btn btn-danger hapus ml-2" id="' . $data->id . '" name="hapus">Hapus</button>';
                    return $button;
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
        return view('owner.stockObat.main');
    }

    public function getNamaObat(Request $request)
    {
        $data = DB::select('SELECT a.id,a.nama,b.kategori from obats a join kategoris b on a.kategori = b.id');
        if ($request->ajax()) {
            return Datatables::of($data)
                // ->addIndexColumn()
                ->addColumn('aksi', function ($data) {
                    $button = '<div class="btn-group">
                        <button type="button" class="btn btn-primary klik" id="' . $data->id . '" value=" ' . $data->nama . '" >
                            <i class="fas fa-mouse-pointer"></i>
                        </button>
                        </div>';
                    // $button = '<button class="btn btn-primary edit" id="' . $data->id . '" name="edit">Edit</button>';
                    // $button .= '<button class="btn btn-danger hapus ml-2" id="' . $data->id . '" name="hapus">Hapus</button>';
                    return $button;
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
    }
}
