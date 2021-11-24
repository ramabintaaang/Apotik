<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ObatController extends Controller
{
    public function index(Request $request)
    {
        $satuan = DB::select('select * from satuans');
        $kategori = DB::select('select * from kategoris');
        $data = Obat::join();
        //Kalau make query sql biasa langsung di controller pake ini 
        // $data = DB::select('SELECT a.*,b.kategori,c.satuan FROM obats a JOIN kategoris b ON a.kategori =
        //         b.id JOIN satuans c ON a.satuan = c.id');
        if ($request->ajax()) {
            return Datatables::of($data)
                // ->addIndexColumn()
                ->addColumn('aksi', function ($data) {
                    $button = '<button class="btn btn-primary edit" id="' . $data->id . '" name="edit">Edit</button>';
                    $button .= '<button class="btn btn-danger hapus ml-2" id="' . $data->id . '" name="hapus">Hapus</button>';
                    return $button;
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
        return view('owner.obat.main', compact('satuan', 'kategori'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $post = Obat::create($request->all());
        if ($post) {
            return response()->json(['message' => 'data sukses disimpan'], 200);
        } else {
            return response()->json(['message' => 'data gagal disimpan'], 400);
        }
    }

    public function edit(Request $request)
    {
        $data = Obat::find($request->id);
        return response()->json([
            'message' => 'Berhasil diambil',
            'data' => $data,
        ]);
    }

    public function update(Request $request)
    {
        // dd($request->all());
        $data = Obat::find($request->id);
        $post = $data->update($request->all());
        if ($post) {
            return response()->json([
                'Message' => 'berhasil update data',
                'data' => $data,
            ], 200);
        } else {
            return response()->json([
                'Message' => 'Gagal update data'
            ], 400);
        }
    }

    public function delete(Request $request)
    {
        $data = Obat::find($request->id);
        $post = $data->delete($request->all());
        if ($post) {
            return response()->json([
                'Message' => 'berhasil hapus data',
                'data' => $data,
            ], 200);
        } else {
            return response()->json([
                'Message' => 'Gagal hapus data'
            ], 400);
        }
    }
}
